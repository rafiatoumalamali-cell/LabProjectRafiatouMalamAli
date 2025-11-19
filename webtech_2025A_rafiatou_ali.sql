--  Users table

USE webtech_2025A_rafiatou_ali;
CREATE TABLE users (
    user_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('student', 'faculty', 'faculty_intern') NOT NULL,
    dob DATE,
    username VARCHAR(50) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

--  Students table (only contains users with role = 'student')
CREATE TABLE students (
    student_id INT PRIMARY KEY,  -- references user_id from users
    department VARCHAR(100),
    year_level VARCHAR(20),  
    FOREIGN KEY (student_id) REFERENCES users(user_id) on delete cascade
);

-- Faculty table (only contains users with role = 'faculty')
CREATE TABLE faculty (
    faculty_id INT PRIMARY KEY,  -- references user_id from users
    department VARCHAR(100),
    position VARCHAR(50),

    FOREIGN KEY (faculty_id) REFERENCES users(user_id) on delete cascade
);

-- 4. Courses table (each course is taught by one faculty)
CREATE TABLE courses (
    course_id INT PRIMARY KEY AUTO_INCREMENT,
    course_code VARCHAR(20) UNIQUE,
    course_name VARCHAR(150) NOT NULL,
    description TEXT,
    credit_hours INT,
    faculty_id INT NOT NULL,  -- references faculty(faculty_id)
    schedule_days VARCHAR(50),
    schedule_time TIME,

    FOREIGN KEY (faculty_id) REFERENCES faculty(faculty_id)
);

-- Course_Student_List table (students enrolled in courses)
CREATE TABLE course_student_list (
    enrollment_id INT PRIMARY KEY AUTO_INCREMENT,
    course_id INT NOT NULL,
    student_id INT NOT NULL,
    enrollment_role ENUM('student', 'auditor', 'observer') DEFAULT 'student',
    enrolled_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(course_id),
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    UNIQUE KEY (course_id, student_id)
);

-- 6. Sessions table (each session belongs to a course)
CREATE TABLE sessions (
    session_id INT PRIMARY KEY AUTO_INCREMENT,
    course_id INT NOT NULL,
    session_title VARCHAR(150),
    location VARCHAR(100),
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    session_date DATE NOT NULL,
    status ENUM('upcoming', 'completed', 'canceled') DEFAULT 'upcoming',
    FOREIGN KEY (course_id) REFERENCES courses(course_id),
    CHECK (end_time > start_time)
);

-- Attendance table (tracks student attendance per session)
CREATE TABLE attendance (
    attendance_id INT PRIMARY KEY AUTO_INCREMENT,
    session_id INT NOT NULL,
    student_id INT NOT NULL,  -- references students(student_id)
    status ENUM('present', 'absent', 'late') NOT NULL,
    check_in_time TIME,
    remarks TEXT,
    marked_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (session_id) REFERENCES sessions(session_id),
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    UNIQUE KEY unique_attendance (session_id, student_id)
);

create TABLE grades (
    grade_id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT NOT NULL,
    course_id INT NOT NULL,
    assessment_type VARCHAR(50) NOT NULL, 
    grade_value VARCHAR(5) NOT NULL,
    feedback TEXT,
    graded_by INT,
    graded_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(course_id),
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    FOREIGN KEY (graded_by) REFERENCES faculty(faculty_id)
    
);
