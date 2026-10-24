-- 動作確認用のダミーデータ（曲名・係数・ゴーストはすべて架空）。本番データではない。
-- 本番のスキーマ (mysqldump --no-data) を流し込んだあとに読み込む。MySQL 8.0 の WITH RECURSIVE を使う。
--
-- 曲は 30 曲 × ANOTHER / LEGGENDARIA の 60 譜面。譜面ごとに「強さ」(レーティング換算) を決め、
-- EASY の 50% ラインがその値、ランプが 1 段上がるごとに 150 ずつ上がるように係数を置く。
-- ゴーストは IndicatorComponent::getGhostNum() と同じ 24196 人。各ゴーストに 1000〜2600 の強さを割り当て、
-- 約 1/6 の譜面に、強さの差に応じたランプ (ノイズあり) を付ける。乱数の代わりに CRC32 を使うので毎回同じ値になる。

SET SESSION cte_max_recursion_depth = 30000;

-- 譜面
INSERT INTO scores (
    id, title, version_num, level, difficulty, notes, textage_url_1p, textage_url_2p, is_deleted, is_rated,
    easy_intercept, easy_coefficient, easy_cfactor, clear_intercept, clear_coefficient, clear_cfactor,
    hard_intercept, hard_coefficient, hard_cfactor, exhard_intercept, exhard_coefficient, exhard_cfactor,
    fc_intercept, fc_coefficient, fc_cfactor
)
WITH RECURSIVE song AS (
    SELECT 1 AS n UNION ALL SELECT n + 1 FROM song WHERE n < 30
), chart AS (
    SELECT
        (song.n - 1) * 2 + d.diff - 2 AS id,
        song.n,
        d.diff,
        -- 譜面の強さ。曲番号が大きいほど難しく、LEGGENDARIA は 150 上
        1200 + (song.n - 1) * 45 + (d.diff - 3) * 150 AS strength
    FROM song CROSS JOIN (SELECT 3 AS diff UNION ALL SELECT 4) AS d
)
SELECT
    id,
    CONCAT('Sample Song ', LPAD(n, 2, '0')),
    20 + n % 14,
    12,
    diff,
    1500 + n * 20 + diff * 10,
    '', '',
    -- 30 曲目の LEGGENDARIA は削除済み、29 曲目の LEGGENDARIA は未評価
    IF(n = 30 AND diff = 4, 1, 0),
    IF(n = 29 AND diff = 4, 0, 1),
    -(strength + 0) * 0.004, 0.004, 0,
    -(strength + 150) * 0.004, 0.004, 0,
    -(strength + 300) * 0.004, 0.004, 0,
    -(strength + 450) * 0.004, 0.004, 0,
    -(strength + 600) * 0.004, 0.004, 0
FROM chart;

-- ゴースト
INSERT INTO ghosts (id, iidx_id, grade, rating)
WITH RECURSIVE g AS (
    SELECT 1 AS id UNION ALL SELECT id + 1 FROM g WHERE id < 24196
)
SELECT id, 10000000 + id, 10 + CRC32(CONCAT('grade', id)) % 9, 1000 + (CRC32(CONCAT('ghost', id)) % 16000) / 10
FROM g;

-- ゴーストのランプ
INSERT INTO ghost_lamps (ghost_id, score_id, lamp)
SELECT ghost_id, score_id, GREATEST(1, LEAST(7, 3 + FLOOR(x)))
FROM (
    SELECT
        ghosts.id AS ghost_id,
        scores.id AS score_id,
        -- 強さの差 (150 で 1 段) に -1〜+1 のノイズを足す
        (ghosts.rating - (-scores.easy_intercept / scores.easy_coefficient)) / 150
            + (CAST(CRC32(CONCAT(scores.id, ':', ghosts.id)) % 201 AS SIGNED) - 100) / 100 AS x
    FROM ghosts CROSS JOIN scores
    WHERE CRC32(CONCAT(ghosts.id, '-', scores.id)) % 6 = 0
) AS t;
