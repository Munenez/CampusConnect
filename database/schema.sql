CREATE DATABASE IF NOT EXISTS campusconnect;
USE campusconnect;

CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    student_id VARCHAR(20) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password_hash VARCHAR(255) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    major VARCHAR(100),
    year INT,
    interests TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE events (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    category ENUM('academic', 'social', 'sports', 'club', 'career') NOT NULL,
    event_date DATE NOT NULL,
    event_time TIME NOT NULL,
    location VARCHAR(255) NOT NULL,
    capacity INT DEFAULT 100,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE event_registrations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE KEY (user_id, event_id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (event_id) REFERENCES events(id)
);

INSERT INTO users (student_id, email, password_hash, first_name, last_name, major, year, interests) VALUES
('S001', 'john@university.edu', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'John', 'Doe', 'Computer Science', 3, 'technology,coding,sports');

INSERT INTO events (title, description, category, event_date, event_time, location) VALUES
('AI Workshop', 'Introduction to Machine Learning', 'academic', '2024-03-15', '14:00:00', 'Tech Lab 301'),
('Basketball Tournament', 'Annual Championship', 'sports', '2024-03-18', '16:00:00', 'Sports Complex'),
('Career Fair', 'Meet top employers', 'career', '2024-03-20', '10:00:00', 'Main Hall');