-- Insurance Database Setup Script
-- Assignment 1 - HTTP5225

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS assignment1;
USE assignment1;

-- Drop existing tables if they exist
DROP TABLE IF EXISTS payments;
DROP TABLE IF EXISTS customer_claims;
DROP TABLE IF EXISTS customer_policies;
DROP TABLE IF EXISTS customers;

-- Create customers table
CREATE TABLE customers (
    customer_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address TEXT NOT NULL,
    birth_date DATE NOT NULL,
    join_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('active', 'inactive', 'suspended') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Create customer_policies table
CREATE TABLE customer_policies (
    policy_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    policy_number VARCHAR(20) UNIQUE NOT NULL,
    policy_type ENUM('auto', 'home', 'life', 'health', 'business') NOT NULL,
    coverage_amount DECIMAL(12,2) NOT NULL,
    premium_amount DECIMAL(8,2) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    status ENUM('active', 'expired', 'cancelled') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id) ON DELETE CASCADE
);

-- Create customer_claims table
CREATE TABLE customer_claims (
    claim_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    policy_id INT NOT NULL,
    claim_number VARCHAR(20) UNIQUE NOT NULL,
    claim_type ENUM('accident', 'theft', 'damage', 'medical', 'liability') NOT NULL,
    claim_amount DECIMAL(10,2) NOT NULL,
    claim_date DATE NOT NULL,
    status ENUM('pending', 'approved', 'rejected', 'paid') DEFAULT 'pending',
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id) ON DELETE CASCADE,
    FOREIGN KEY (policy_id) REFERENCES customer_policies(policy_id) ON DELETE CASCADE
);

-- Create payments table
CREATE TABLE payments (
    payment_id INT AUTO_INCREMENT PRIMARY KEY,
    customer_id INT NOT NULL,
    policy_id INT NOT NULL,
    payment_number VARCHAR(20) UNIQUE NOT NULL,
    payment_type ENUM('premium', 'claim', 'refund') NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_date DATE NOT NULL,
    payment_method ENUM('credit_card', 'bank_transfer', 'cash', 'check') NOT NULL,
    status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id) ON DELETE CASCADE,
    FOREIGN KEY (policy_id) REFERENCES customer_policies(policy_id) ON DELETE CASCADE
);

-- Insert sample customers
INSERT INTO customers (first_name, last_name, email, phone, address, birth_date) VALUES
('John', 'Smith', 'john.smith@email.com', '555-0101', '123 Main St, Toronto, ON M5V 2H1', '1985-03-15'),
('Sarah', 'Johnson', 'sarah.johnson@email.com', '555-0102', '456 Oak Ave, Vancouver, BC V6B 1A1', '1990-07-22'),
('Michael', 'Brown', 'michael.brown@email.com', '555-0103', '789 Pine Rd, Montreal, QC H2Y 1C6', '1978-11-08'),
('Emily', 'Davis', 'emily.davis@email.com', '555-0104', '321 Elm St, Calgary, AB T2P 1J9', '1992-04-30'),
('David', 'Wilson', 'david.wilson@email.com', '555-0105', '654 Maple Dr, Edmonton, AB T5J 0R2', '1983-09-12'),
('Lisa', 'Anderson', 'lisa.anderson@email.com', '555-0106', '987 Cedar Ln, Ottawa, ON K1P 1J1', '1987-12-05'),
('Robert', 'Taylor', 'robert.taylor@email.com', '555-0107', '147 Birch Way, Winnipeg, MB R3C 0P8', '1975-06-18'),
('Jennifer', 'Martinez', 'jennifer.martinez@email.com', '555-0108', '258 Spruce Ct, Halifax, NS B3J 1S9', '1989-01-25');

-- Insert sample policies
INSERT INTO customer_policies (customer_id, policy_number, policy_type, coverage_amount, premium_amount, start_date, end_date) VALUES
(1, 'POL-2024-001', 'auto', 50000.00, 1200.00, '2024-01-01', '2025-01-01'),
(1, 'POL-2024-002', 'home', 300000.00, 800.00, '2024-01-15', '2025-01-15'),
(2, 'POL-2024-003', 'life', 1000000.00, 2500.00, '2024-02-01', '2025-02-01'),
(3, 'POL-2024-004', 'auto', 75000.00, 1800.00, '2024-02-15', '2025-02-15'),
(4, 'POL-2024-005', 'health', 500000.00, 1500.00, '2024-03-01', '2025-03-01'),
(5, 'POL-2024-006', 'business', 2000000.00, 5000.00, '2024-03-15', '2025-03-15'),
(6, 'POL-2024-007', 'auto', 60000.00, 1400.00, '2024-04-01', '2025-04-01'),
(7, 'POL-2024-008', 'home', 400000.00, 1000.00, '2024-04-15', '2025-04-15'),
(8, 'POL-2024-009', 'life', 750000.00, 2000.00, '2024-05-01', '2025-05-01'),
(2, 'POL-2024-010', 'auto', 45000.00, 1100.00, '2024-05-15', '2025-05-15');

-- Insert sample claims
INSERT INTO customer_claims (customer_id, policy_id, claim_number, claim_type, claim_amount, claim_date, status, description) VALUES
(1, 1, 'CLM-2024-001', 'accident', 5000.00, '2024-01-20', 'approved', 'Minor fender bender in parking lot'),
(3, 4, 'CLM-2024-002', 'theft', 3000.00, '2024-02-25', 'pending', 'Car stereo and GPS stolen'),
(5, 6, 'CLM-2024-003', 'damage', 15000.00, '2024-03-10', 'approved', 'Fire damage to office building'),
(7, 8, 'CLM-2024-004', 'damage', 8000.00, '2024-04-05', 'rejected', 'Water damage from burst pipe'),
(2, 3, 'CLM-2024-005', 'medical', 2500.00, '2024-05-12', 'paid', 'Emergency room visit'),
(4, 5, 'CLM-2024-006', 'medical', 1200.00, '2024-06-01', 'pending', 'Dental procedure'),
(6, 7, 'CLM-2024-007', 'accident', 3500.00, '2024-06-15', 'approved', 'Rear-end collision'),
(8, 9, 'CLM-2024-008', 'liability', 10000.00, '2024-07-01', 'pending', 'Slip and fall accident');

-- Insert sample payments
INSERT INTO payments (customer_id, policy_id, payment_number, payment_type, amount, payment_date, payment_method, status) VALUES
(1, 1, 'PAY-2024-001', 'premium', 1200.00, '2024-01-01', 'credit_card', 'completed'),
(1, 2, 'PAY-2024-002', 'premium', 800.00, '2024-01-15', 'bank_transfer', 'completed'),
(2, 3, 'PAY-2024-003', 'premium', 2500.00, '2024-02-01', 'credit_card', 'completed'),
(3, 4, 'PAY-2024-004', 'premium', 1800.00, '2024-02-15', 'bank_transfer', 'completed'),
(4, 5, 'PAY-2024-005', 'premium', 1500.00, '2024-03-01', 'credit_card', 'completed'),
(5, 6, 'PAY-2024-006', 'premium', 5000.00, '2024-03-15', 'bank_transfer', 'completed'),
(6, 7, 'PAY-2024-007', 'premium', 1400.00, '2024-04-01', 'credit_card', 'completed'),
(7, 8, 'PAY-2024-008', 'premium', 1000.00, '2024-04-15', 'bank_transfer', 'completed'),
(8, 9, 'PAY-2024-009', 'premium', 2000.00, '2024-05-01', 'credit_card', 'completed'),
(2, 10, 'PAY-2024-010', 'premium', 1100.00, '2024-05-15', 'bank_transfer', 'completed'),
(1, 1, 'PAY-2024-011', 'claim', 5000.00, '2024-01-25', 'bank_transfer', 'completed'),
(3, 4, 'PAY-2024-012', 'claim', 3000.00, '2024-03-01', 'bank_transfer', 'pending'),
(5, 6, 'PAY-2024-013', 'claim', 15000.00, '2024-03-20', 'bank_transfer', 'completed'),
(2, 3, 'PAY-2024-014', 'claim', 2500.00, '2024-05-20', 'bank_transfer', 'completed'),
(6, 7, 'PAY-2024-015', 'claim', 3500.00, '2024-06-25', 'bank_transfer', 'completed');

-- Create indexes for better performance
CREATE INDEX idx_customer_email ON customers(email);
CREATE INDEX idx_policy_customer ON customer_policies(customer_id);
CREATE INDEX idx_claim_customer ON customer_claims(customer_id);
CREATE INDEX idx_payment_customer ON payments(customer_id);
CREATE INDEX idx_policy_number ON customer_policies(policy_number);
CREATE INDEX idx_claim_number ON customer_claims(claim_number);
CREATE INDEX idx_payment_number ON payments(payment_number); 