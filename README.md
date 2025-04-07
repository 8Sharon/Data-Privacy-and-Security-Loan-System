# Data Privacy and Security Loan System
The **Data Privacy and Security Loan System** is a web-based application designed to provide a secure and efficient platform for managing loans. With a strong focus on data privacy, real-time monitoring of unauthorized access, and tracking overdue repayments, this system ensures that financial institutions can operate with confidence while protecting sensitive user information. It offers distinct workflows for clients and administrators, making it a versatile tool for loan management.
(https://garudax.com/wp-content/uploads/2024/08/iStock-1402450534_sme-e1723393287864.jpg.webp)
---

## Table of Contents

1. [Project Overview](#project-overview)
2. [Key Features](#key-features)
3. [System Architecture](#system-architecture)
4. [Detailed Workflow](#detailed-workflow)
   - [Real-Time Monitoring](#real-time-monitoring)
   - [Client Authentication Flow](#client-authentication-flow)
   - [Admin Authentication Flow](#admin-authentication-flow)
   - [Failed Login Attempt Alerts](#failed-login-attempt-alerts)
5. [Technology Stack](#technology-stack)
6. [Installation Guide](#installation-guide)
7. [Usage Instructions](#usage-instructions)
8. [Security Implementation](#security-implementation)
   - [Password Hashing with MD5](#password-hashing-with-md5)
9. [Testing the System](#testing-the-system)
10. [Contributing Guidelines](#contributing-guidelines)
11. [Future Improvements](#future-improvements)
12. [Contact Information](#contact-information)

---

## Project Overview

The Data Privacy and Security Loan System was created to address the critical needs of modern loan management: security, transparency, and efficiency. By integrating real-time monitoring for unauthorized access and overdue repayments, the system provides actionable insights to administrators while maintaining a user-friendly experience for clients. Whether you're a client checking your loan status or an admin overseeing the entire system, this platform ensures data privacy and operational reliability.

---

## Key Features

- **Real-Time Monitoring**: Instantly detects unauthorized access attempts and overdue loan repayments.
- **Data Privacy**: Protects sensitive information with encryption and secure authentication.
- **Role-Based Redirection**: Clients access a Home Page, while admins access a Dashboard.
- **Failed Login Alerts**: Notifies admins when a client exceeds three failed login attempts.
- **Simple Authentication**: Uses MD5 hashing for password security.
- **Scalable Design**: Supports growth in users and loan volume.
- **Audit Logs**: Tracks all system activities for accountability.

---

## System Architecture

The system follows a client-server architecture:
- **Frontend**: HTML,CSS  for user interfaces, with  JavaScript for interactivity.
- **Backend**: PHP handles server-side logic, authentication, and database interactions.
- **Database**: MySQL stores user credentials, loan details, and monitoring logs.

---

## Detailed Workflow

### Real-Time Monitoring

Real-time monitoring is the cornerstone of this system, ensuring proactive management of security and financial risks.

1. **Unauthorized Access Detection**:
   - Every login attempt (successful or failed) is logged with a timestamp, IP address, and username/email.
   - The system scans for suspicious activity, such as rapid successive failed attempts.
   - Alerts are generated and sent to the admin dashboard for immediate review.

2. **Overdue Repayments Tracking**:
   - Loan repayment schedules are stored in the database with due dates.
   - A background script runs daily to compare due dates with payment records.
   - Overdue loans are flagged, and details (e.g., client ID, amount, days overdue) are displayed on the admin dashboard.

### Client Authentication Flow

- **Access Point**: Clients begin at `client-login.php`, a PHP script handling registration and login.
- **Registration Process**:
  - Clients enter details like name, email, and password in a secure form.
  - The password is hashed using MD5 (more on this in [Security Implementation](#security-implementation)).
  - Upon successful registration, the client is logged in automatically.
- **Login Process**:
  - Clients submit their email and password.
  - The system hashes the entered password with MD5 and compares it to the stored hash.
- **Redirection**:
  - After successful login or registration, the client is redirected to the **Home Page** (`home.php`).
  - The Home Page displays loan details, repayment schedules, and account information in a clean, accessible layout.

### Admin Authentication Flow

- **Access Point**: Admins use `admin.php` for registration and login.
- **Registration Process**:
  - Admins provide a username, email, and password, often with an additional admin key for authorization.
  - The password is hashed with MD5 and stored in the database.
  - Successful registration logs the admin in automatically.
- **Login Process**:
  - Admins enter their credentials (username/email and password).
  - The system hashes the password with MD5 and verifies it against the stored value.
- **Redirection**:
  - Upon successful login or registration, the admin is redirected to the **Admin Dashboard** (`dashboard.php`).
  - The dashboard offers a comprehensive view of all clients, loans, overdue payments, and security alerts.

### Failed Login Attempt Alerts

- **Tracking Mechanism**:
  - Each failed login attempt on `client-login.php` increments a counter tied to the client’s email.
  - The counter is stored in the database or a session variable.
- **Threshold**:
  - If the counter exceeds **3 failed attempts**, the system triggers an alert.
- **Alert Delivery**:
  - An alert is sent to the **Admin Dashboard** in real time, displayed as a notification.
  - Details include the client’s email, number of attempts, and timestamp.
- 
---

## Technology Stack

- **Frontend**: HTML, CSS, JavaScript .
- **Backend**: PHP 7.4+ for server-side processing.
- **Database**: MySQL 5.7+ for data storage.
- **Hashing**: MD5 for password security.
- **Server**: Apache  with PHP support.
- **Tools**: Git for version control, Composer for PHP dependencies.

---
## Installation Guide

To set up the system locally or on a server:

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/8Sharon/data-privacy-security-loan-system.git
2. **Set Up the Web Server**:
   install Apache and PHP ( via XAMPP or manually).
   Copy the project folder to the server’s root ( htdocs).
3. **Database Setup**:
   Install MySQL and create a database (e.gloan).
   Import the provided schema.sql file
4. **Install Dependencies**:
   Install a visual studio code for code editing.

## Usage Instructions

### Clients:
1. Navigate to `http://yourdomain.com/client-login.php`.
2. Register or log in to access the **Home Page** (`home.php`).
3. Once logged in, you can:
   - View and apply your loan details.
   - Make repayments as needed.

### Admins:
1. Go to `http://yourdomain.com/admin.php`.
2. Register or log in to access the **Admin Dashboard** (`dashboard.php`).
3. Once logged in, you can:
   - Monitor overdue loans.
   - View real-time security alerts and manage user accounts.

### Monitoring:
- Admins can check the **Dashboard** for real-time updates on system activity.
- The dashboard will provide information on:
  - Failed login attempts.
  - Overdue loan repayments.
  - Reports on loan applications
 ## Security Implementation

### Password Hashing with MD5

#### Method:
Passwords are hashed using the **MD5** algorithm before storage to ensure they are not stored in plain-text, enhancing the security of user credentials.

#### Process:
When a user registers or logs in, their plain-text password is passed through the MD5 hashing function:

$hashed_password = md5($plain_password);
## Testing the System

### 1. Client Login:
- **Test with valid credentials**:  
  Navigate to `http://yourdomain.com/client-login.php` and log in using valid client credentials. Ensure you are redirected to the **Home Page** (`home.php`).
  
- **Test with invalid credentials**:  
  Enter incorrect login details (wrong username/password) on the login form. Ensure that an error message is shown, and you remain on the login page.

### 2. Failed Attempts:
- **Trigger an alert for failed login attempts**:  
  On the **Client Login** page, try entering incorrect passwords 4 or more times.  
  After the third failed attempt, the system should trigger an alert, which can be verified in the **Admin Dashboard**. Ensure that the admin is notified and the client's account is temporarily locked (or any other protective measure is activated).

### 3. Admin Dashboard:
- **Log in to the Admin Dashboard**:  
  Navigate to `http://yourdomain.com/admin.php` and log in using admin credentials.  
  Verify that after successful login, you are redirected to the **Admin Dashboard** (`dashboard.php`).  
  Check that the **Failed Login Alerts** and other relevant information are visible and up to date in the dashboard.

### 4. Overdue Loans:
- **Test overdue loans**:  
  - Manually set a loan's due date to a date in the past using a database management tool (e.g., phpMyAdmin).
  - Verify that the overdue loan is displayed on the **Admin Dashboard**, indicating it is past due.
  - Ensure that admin is notified about the overdue loan, and the system tracks the overdue status properly.
## Contributing Guidelines

We welcome contributions! If you'd like to contribute to this project, please follow the steps below:

### 1. Fork the Repository
Fork the repository to your own GitHub account by clicking the **Fork** button at the top-right of the repository page.

### 2. Create a Branch
After forking the repository, create a new branch for your feature or bug fix:
``bash
git checkout -b feature/your-feature
## Future Improvements

### 1. Stronger Hashing
- **Replace MD5 with bcrypt or Argon2**:  
  MD5 is considered outdated and vulnerable to brute-force attacks. For enhanced security, we plan to replace MD5 with more secure hashing algorithms like **bcrypt** or **Argon2**, which offer stronger protection against password cracking.

### 2. Multi-Factor Authentication
- **Add SMS or email verification**:  
  Implementing **multi-factor authentication (MFA)** will add an extra layer of security. Clients and admins will be required to verify their identity through a second method, such as SMS or email verification, before being granted access to their accounts.

### 3. API Integration
- **Allow third-party apps to interact with the system**:  
  We plan to develop a robust **API** that will allow third-party applications to interact with the loan system. This will enable integrations with other financial systems, mobile apps, or reporting tools, increasing the system's flexibility and usability.

### 4. Payment Gateway Integration
- **Integrate online payment options for clients**:  
  To streamline loan repayments, we aim to integrate a secure **payment gateway** (such as PayPal, Stripe, or a bank transfer API) to allow clients to make online payments directly through the system. This will improve user experience by offering a seamless and convenient way to pay loans.

---

These are some of the exciting improvements we plan to implement to make the loan system more secure, accessible, and feature-rich in the future.
## Contact Information

- **Email**: njerisharon611@gmail.com
- **GitHub**: File issues at [github.com/8Sharon/Data-Privacy-and-Security-Loan-System/issues](https://github.com/8Sharon/Data-Privacy-and-Security-Loan-System/issues)
- **Lead Developer**: Sharon Kamau (njerisharon611@gmail.com)




  
