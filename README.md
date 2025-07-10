# ACLC College of Commonwealth School Voting System

## Table of Contents
1. [Overview](#overview)
2. [System Requirements](#system-requirements)
3. [Installation Guide](#installation-guide)
4. [User Roles and Access](#user-roles-and-access)
5. [Core Features](#core-features)
6. [Database Structure](#database-structure)
7. [API Documentation](#api-documentation)
8. [Security Features](#security-features)
9. [User Manual](#user-manual)
10. [Administrator Manual](#administrator-manual)
11. [Troubleshooting](#troubleshooting)

---

## Overview

The ACLC College of Commonwealth School Voting System is a web-based application designed to facilitate secure, transparent, and efficient electronic voting for student elections and organizational polls within the college. The system provides a digital platform for conducting various types of elections including student government, club elections, and academic surveys.

### Key Benefits
- **Secure Voting**: Advanced security measures to prevent fraud and ensure vote integrity
- **Real-time Results**: Instant vote counting and result generation
- **User-friendly Interface**: Intuitive design for both voters and administrators
- **Audit Trail**: Comprehensive logging of all voting activities
- **Accessibility**: Web-based platform accessible from any device with internet connectivity

---

## System Requirements

### Server Requirements
- **Web Server**: Apache 2.4+ or Nginx 1.18+
- **PHP Version**: PHP 7.4 or higher (PHP 8.0+ recommended)
- **Database**: MySQL 5.7+ or MariaDB 10.3+
- **Memory**: Minimum 2GB RAM (4GB recommended)
- **Storage**: Minimum 1GB free disk space

### PHP Extensions Required
- `mysqli` or `pdo_mysql`
- `gd` (for image processing)
- `mbstring`
- `openssl`
- `curl`
- `json`
- `session`

### Client Requirements
- Modern web browser (Chrome 80+, Firefox 75+, Safari 13+, Edge 80+)
- JavaScript enabled
- Internet connection

---

## Installation Guide

### Step 1: Download and Extract
1. Clone the repository or download the source code
2. Extract files to your web server directory (e.g., `/var/www/html/voting-system/`)

### Step 2: Database Setup
1. Create a new MySQL database:
   ```sql
   CREATE DATABASE aclc_voting_system;
   ```

2. Import the database schema:
   ```bash
   mysql -u username -p aclc_voting_system < database/schema.sql
   ```

3. Import sample data (optional):
   ```bash
   mysql -u username -p aclc_voting_system < database/sample_data.sql
   ```

### Step 3: Configuration
1. Copy `config/config.example.php` to `config/config.php`
2. Edit the configuration file with your database credentials:
   ```php
   <?php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'your_username');
   define('DB_PASS', 'your_password');
   define('DB_NAME', 'aclc_voting_system');
   
   // Security settings
   define('SECRET_KEY', 'your-secret-key-here');
   define('ENCRYPTION_KEY', 'your-encryption-key-here');
   ?>
   ```

### Step 4: File Permissions
Set appropriate permissions for the application:
```bash
chmod -R 755 /var/www/html/voting-system/
chmod -R 777 /var/www/html/voting-system/uploads/
chmod -R 777 /var/www/html/voting-system/logs/
```

### Step 5: Initial Setup
1. Access the application: `http://your-domain/voting-system/`
2. Complete the initial setup wizard
3. Create the first administrator account

---

## User Roles and Access

### 1. Super Administrator
- **Full system access**
- User management
- Election configuration
- System settings
- Database maintenance
- Security management

### 2. Administrator
- **Election management**
- Candidate registration
- Voter registration
- Results generation
- Basic system configuration

### 3. Election Officer
- **Election oversight**
- Monitor voting process
- Generate reports
- Manage election day operations

### 4. Voter
- **Voting privileges**
- View election information
- Cast votes
- View personal voting history

---

## Core Features

### Election Management
- **Multiple Election Types**: Support for various election categories (Student Government, Club Elections, Academic Surveys)
- **Flexible Voting Periods**: Configurable start and end times for elections
- **Position Management**: Create and manage different positions with specific requirements
- **Ballot Customization**: Design custom ballots with different voting methods

### Candidate Management
- **Candidate Registration**: Streamlined process for candidate applications
- **Profile Management**: Comprehensive candidate information and photos
- **Qualification Verification**: Automated checking of candidate eligibility
- **Campaign Materials**: Platform for candidate statements and manifestos

### Voter Management
- **Automated Registration**: Integration with student information system
- **Eligibility Verification**: Automated checking of voter qualifications
- **Voter Authentication**: Multiple authentication methods (Student ID, Email, Biometric)
- **Voting History**: Track individual voting participation

### Voting Process
- **Secure Ballot Interface**: User-friendly voting interface with confirmation steps
- **Vote Preview**: Allow voters to review selections before final submission
- **Vote Encryption**: All votes encrypted before storage
- **Real-time Validation**: Immediate verification of vote integrity

### Results and Reporting
- **Real-time Results**: Live vote counting and result display
- **Comprehensive Reports**: Detailed election statistics and analytics
- **Export Functions**: Export results in multiple formats (PDF, Excel, CSV)
- **Audit Reports**: Complete audit trail for election verification

---

## Database Structure

### Core Tables

#### elections
```sql
CREATE TABLE elections (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    start_date DATETIME NOT NULL,
    end_date DATETIME NOT NULL,
    status ENUM('draft', 'active', 'completed', 'cancelled') DEFAULT 'draft',
    created_by INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

#### positions
```sql
CREATE TABLE positions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    election_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    max_votes INT DEFAULT 1,
    order_index INT DEFAULT 0,
    FOREIGN KEY (election_id) REFERENCES elections(id)
);
```

#### candidates
```sql
CREATE TABLE candidates (
    id INT PRIMARY KEY AUTO_INCREMENT,
    position_id INT NOT NULL,
    student_id VARCHAR(20) NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    course VARCHAR(100),
    year_level INT,
    photo VARCHAR(255),
    platform TEXT,
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    FOREIGN KEY (position_id) REFERENCES positions(id)
);
```

#### voters
```sql
CREATE TABLE voters (
    id INT PRIMARY KEY AUTO_INCREMENT,
    student_id VARCHAR(20) UNIQUE NOT NULL,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    course VARCHAR(100),
    year_level INT,
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

#### votes
```sql
CREATE TABLE votes (
    id INT PRIMARY KEY AUTO_INCREMENT,
    election_id INT NOT NULL,
    voter_id INT NOT NULL,
    position_id INT NOT NULL,
    candidate_id INT NOT NULL,
    vote_hash VARCHAR(255) NOT NULL,
    ip_address VARCHAR(45),
    user_agent TEXT,
    voted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (election_id) REFERENCES elections(id),
    FOREIGN KEY (voter_id) REFERENCES voters(id),
    FOREIGN KEY (position_id) REFERENCES positions(id),
    FOREIGN KEY (candidate_id) REFERENCES candidates(id)
);
```

---

## API Documentation

### Authentication Endpoints

#### POST /api/auth/login
Authenticate a user and return access token.

**Request Body:**
```json
{
    "student_id": "2023-12345",
    "password": "user_password"
}
```

**Response:**
```json
{
    "success": true,
    "message": "Login successful",
    "data": {
        "token": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...",
        "user": {
            "id": 1,
            "student_id": "2023-12345",
            "name": "John Doe",
            "role": "voter"
        }
    }
}
```

### Election Endpoints

#### GET /api/elections
Get list of available elections.

**Response:**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "title": "Student Government Election 2024",
            "description": "Annual student government election",
            "start_date": "2024-03-01 08:00:00",
            "end_date": "2024-03-01 18:00:00",
            "status": "active"
        }
    ]
}
```

#### GET /api/elections/{id}/ballot
Get ballot information for a specific election.

**Response:**
```json
{
    "success": true,
    "data": {
        "election": {
            "id": 1,
            "title": "Student Government Election 2024"
        },
        "positions": [
            {
                "id": 1,
                "title": "President",
                "max_votes": 1,
                "candidates": [
                    {
                        "id": 1,
                        "name": "Jane Smith",
                        "course": "BSIT",
                        "year_level": 4,
                        "photo": "uploads/candidates/1.jpg"
                    }
                ]
            }
        ]
    }
}
```

### Voting Endpoints

#### POST /api/vote
Submit a vote for an election.

**Request Body:**
```json
{
    "election_id": 1,
    "votes": [
        {
            "position_id": 1,
            "candidate_id": 1
        },
        {
            "position_id": 2,
            "candidate_id": 3
        }
    ]
}
```

**Response:**
```json
{
    "success": true,
    "message": "Vote submitted successfully",
    "data": {
        "vote_id": "VT-2024-001234",
        "timestamp": "2024-03-01 10:30:00"
    }
}
```

---

## Security Features

### Data Protection
- **Encryption**: All sensitive data encrypted using AES-256
- **Password Security**: Passwords hashed using bcrypt with salt
- **SQL Injection Prevention**: Parameterized queries and input validation
- **XSS Protection**: Output encoding and Content Security Policy

### Authentication & Authorization
- **Multi-factor Authentication**: Optional 2FA for administrators
- **Role-based Access Control**: Granular permissions system
- **Session Management**: Secure session handling with timeout
- **Login Attempt Limiting**: Brute force protection

### Audit & Monitoring
- **Complete Audit Trail**: All actions logged with timestamps
- **Real-time Monitoring**: System health and security monitoring
- **Suspicious Activity Detection**: Automated alerts for unusual patterns
- **Data Integrity Checks**: Regular validation of vote data

### Network Security
- **HTTPS Enforcement**: SSL/TLS encryption for all communications
- **CSRF Protection**: Cross-site request forgery prevention
- **Rate Limiting**: API request throttling
- **IP Whitelisting**: Optional IP-based access control

---

## User Manual

### For Voters

#### Logging In
1. Navigate to the voting system URL
2. Enter your Student ID and password
3. Click "Login" to access the system

#### Viewing Elections
1. After login, you'll see available elections on the dashboard
2. Click "View Details" to see election information
3. Check eligibility requirements and voting period

#### Casting Your Vote
1. Click "Vote Now" for an active election
2. Review the ballot and candidate information
3. Select your preferred candidates for each position
4. Click "Review Vote" to preview your selections
5. Confirm your vote by clicking "Submit Vote"
6. Save your vote confirmation receipt

#### Viewing Vote History
1. Go to "My Votes" section
2. View your participation history
3. Download vote confirmation receipts

### For Administrators

#### Managing Elections
1. Navigate to "Elections" > "Manage Elections"
2. Click "Create New Election" to add an election
3. Fill in election details (title, description, dates)
4. Configure voting settings and restrictions
5. Save and activate the election

#### Managing Candidates
1. Go to "Candidates" > "Manage Candidates"
2. Review candidate applications
3. Verify candidate qualifications
4. Approve or reject applications
5. Upload candidate photos and information

#### Managing Voters
1. Navigate to "Voters" > "Manage Voters"
2. Import voter list from CSV file
3. Manually add individual voters
4. Update voter information
5. Activate or deactivate voter accounts

#### Monitoring Elections
1. Access "Elections" > "Monitor Elections"
2. View real-time voting statistics
3. Check system health and performance
4. Monitor for any irregularities
5. Generate interim reports

---

## Administrator Manual

### System Configuration

#### General Settings
1. Navigate to "Settings" > "General"
2. Configure system-wide settings:
   - System name and logo
   - Default timezone
   - Email settings
   - Security policies

#### User Management
1. Go to "Users" > "Manage Users"
2. Create administrator accounts
3. Assign roles and permissions
4. Configure user authentication methods

#### Database Management
1. Access "System" > "Database"
2. Perform database backups
3. Optimize database performance
4. Monitor database health

### Security Management

#### Access Control
1. Navigate to "Security" > "Access Control"
2. Configure IP restrictions
3. Set up failed login policies
4. Manage session timeouts

#### Audit Logs
1. Go to "Security" > "Audit Logs"
2. Review system activity logs
3. Export audit reports
4. Set up log retention policies

### Maintenance Procedures

#### Regular Backups
1. Schedule automated database backups
2. Backup application files
3. Test backup restoration procedures
4. Store backups securely off-site

#### System Updates
1. Test updates in staging environment
2. Schedule maintenance windows
3. Apply security patches promptly
4. Document all system changes

---

## Troubleshooting

### Common Issues

#### Login Problems
**Issue**: Users cannot log in
**Solutions**:
- Verify database connection
- Check user credentials in database
- Clear browser cache and cookies
- Verify session configuration

#### Voting Errors
**Issue**: Votes not being recorded
**Solutions**:
- Check database permissions
- Verify election is active
- Ensure voter eligibility
- Check for duplicate votes

#### Performance Issues
**Issue**: System running slowly
**Solutions**:
- Optimize database queries
- Increase server resources
- Enable caching
- Compress static files

### Error Codes

| Code | Description | Solution |
|------|-------------|----------|
| E001 | Database connection failed | Check database credentials |
| E002 | Invalid voter credentials | Verify student ID and password |
| E003 | Election not active | Check election dates and status |
| E004 | Duplicate vote detected | Verify voter hasn't already voted |
| E005 | System maintenance mode | Wait for maintenance completion |

---

## Contributing

We welcome contributions to improve the ACLC College of Commonwealth School Voting System. Please follow these guidelines:

### Development Setup
1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Write tests for new features
5. Submit a pull request

### Code Standards
- Follow PSR-12 coding standards
- Use meaningful variable and function names
- Comment complex logic
- Write unit tests for new features

### Reporting Issues
- Use the GitHub issue tracker
- Provide detailed reproduction steps
- Include system information
- Attach relevant log files

---

## License

This project is licensed under the MIT License. See the `LICENSE` file for details.

### Third-party Libraries
- Bootstrap 5.1.3 (MIT License)
- jQuery 3.6.0 (MIT License)
- Chart.js 3.9.1 (MIT License)
- PHPMailer 6.6.0 (LGPL License)

---

## Changelog

### Version 2.0.0 (Current)
- Enhanced security features
- Improved user interface
- Real-time result updates
- Mobile responsive design
- API integration
- Multi-language support

### Version 1.5.0
- Added audit trail functionality
- Implemented vote encryption
- Enhanced reporting features
- Bug fixes and performance improvements

### Version 1.0.0
- Initial release
- Basic voting functionality
- User management
- Election management
- Result generation

---
