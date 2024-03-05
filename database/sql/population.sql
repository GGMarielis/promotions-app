CREATE TABLE tv_series (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(125) NOT NULL,
    channel VARCHAR(50) NOT NULL,
    gender VARCHAR(50) NOT NULL,
    created_at   TIMESTAMP NULL,
    updated_at   TIMESTAMP NULL,
    CONSTRAINT tv_series_title_unique UNIQUE (title)
);

create table tv_series_intervals
(
    id_tv_series BIGINT UNSIGNED NOT NULL,
    week_day     ENUM ('MONDAY', 'WEDNESDAY', 'TUESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY', 'SUNDAY') not null,
    show_time    TIME NOT NULL,
    created_at   TIMESTAMP NULL,
    updated_at   TIMESTAMP NULL,
    CONSTRAINT tv_series_intervals_id_tv_series_foreign
        FOREIGN KEY (id_tv_series) REFERENCES tv_series(id)
);

INSERT INTO tv_series (title, channel, gender)
VALUES
    ('Breaking Bad', 'Netflix', 'Drama'),
    ('Game of Thrones', 'HBO', 'Fantasy'),
    ('Stranger Things', 'Netflix', 'Horror');

INSERT INTO tv_series_intervals (id_tv_series, week_day, show_time)
VALUES
    ((SELECT id FROM tv_series WHERE title = 'Breaking Bad'), 'MONDAY', '21:00'),
    ((SELECT id FROM tv_series WHERE title = 'Game of Thrones'), 'SUNDAY', '20:00'),
    ((SELECT id FROM tv_series WHERE title = 'Stranger Things'), 'FRIDAY', '22:00');
