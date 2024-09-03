-- create trips table
CREATE TABLE trips (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    start_date DATE,
    cover TEXT,
    number_of_days INT DEFAULT 1
);

-- create days table
CREATE TABLE days (
    id INT AUTO_INCREMENT PRIMARY KEY,
    trip_id INT,
    day_number INT NOT NULL,
    date DATE,
    total_days INT NOT NULL,
    FOREIGN KEY (trip_id) REFERENCES trips(id) ON DELETE CASCADE
);

-- create stages table
CREATE TABLE stages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    day_id INT,
    title VARCHAR(255) NOT NULL,
    stage_number INT NOT NULL,
    description TEXT,
    location VARCHAR(255),
    image TEXT,
    latitude DECIMAL(10, 7),
    longitude DECIMAL(10, 7),
    -- Add foreign key constraint to days table 
    FOREIGN KEY (day_id) REFERENCES days(id) ON DELETE CASCADE
);

