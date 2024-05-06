-- Create the database if it does not exist
CREATE DATABASE IF NOT EXISTS cloudfinalproj;

-- Switch to the specified database
USE cloudfinalproj;

-- Create the student table if it does not exist
CREATE TABLE IF NOT EXISTS student (
    Student_ID INT PRIMARY KEY,
    First_Name VARCHAR(50),
    CGPA DECIMAL(3, 2) CHECK (CGPA >= 0 AND CGPA <= 4), 
    Age INT CHECK (Age > 0)
);

-- Insert data into the student table (avoiding duplicates)
INSERT INTO student (Student_ID, First_Name, CGPA, Age) 
VALUES
    (22010088, 'khatab', 3.00, 20),
    (22010104, 'ziad', 3.00, 19),
    (22010092, 'rawan', 3.00, 19),
    (22010297, 'youmna', 3.00, 20),
    (22010154, 'ammar', 3.00, 20)
ON DUPLICATE KEY UPDATE 
    Student_ID = VALUES(Student_ID), 
    First_Name = VALUES(First_Name), 
    CGPA = VALUES(CGPA), 
    Age = VALUES(Age);