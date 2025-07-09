# Insurance Database Management System
## Assignment 1 - HTTP5225

### Project Overview
This project demonstrates a comprehensive insurance database management system with proper HTML/CSS formatting, W3C validation compliance, and implementation of loops and if/else statements.

### Features Demonstrated
- **Loops**: Multiple while loops to process database records
- **If/Else Statements**: Conditional formatting based on data values
- **HTML/CSS Formatting**: Beautiful, responsive design with modern styling
- **W3C Validation**: Compliant HTML5 and CSS3 code
- **Database Integration**: MySQL database with multiple related tables
- **Responsive Design**: Mobile-friendly interface

### Database Schema
The system includes four main tables:

1. **customers** - Customer information
2. **customer_policies** - Insurance policies
3. **customer_claims** - Insurance claims
4. **payments** - Payment records

### Setup Instructions

#### Prerequisites
- XAMPP (Apache + MySQL)
- PHP 7.4 or higher
- MySQL 5.7 or higher

#### Installation Steps

1. **Start XAMPP**
   - Start Apache and MySQL services
   - Ensure both services are running

2. **Import Database**
   - Open phpMyAdmin (http://localhost/phpmyadmin)
   - Create a new database named `assignment1`
   - Import the `database_setup.sql` file
   - Or run the SQL commands directly in phpMyAdmin

3. **Place Files**
   - Copy all project files to your XAMPP htdocs directory
   - Ensure the path is: `C:\xampp\htdocs\HTTP5225_Kunal\assignment1\assignment1\`

4. **Access the Application**
   - Open your web browser
   - Navigate to: `http://localhost/HTTP5225_Kunal/assignment1/assignment1/insurance_dashboard.php`

### Files Description

- **`database_setup.sql`** - Complete database schema and sample data
- **`insurance_dashboard.php`** - Main application file with comprehensive dashboard
- **`index.php`** - Basic implementation showing customer-policy relationships
- **`validate.html`** - W3C validation test page
- **`README.md`** - This documentation file

### Loop Implementation
The application demonstrates loops in multiple sections:

1. **Customer Loop**: Processes all customer records
2. **Policy Loop**: Displays all insurance policies
3. **Claim Loop**: Shows all insurance claims
4. **Payment Loop**: Lists all payment records

Each loop includes:
- Proper error handling
- Data validation and sanitization

### If/Else Implementation
Conditional formatting is applied based on:

- **Status Values**: Different colors for active, pending, rejected, etc.
- **Amount Ranges**: Color coding for high, medium, and low amounts
- **Policy Types**: Different colors for auto, home, life, health, business
- **Payment Methods**: Formatted display of payment types

### W3C Validation Features
- Valid HTML5 structure
- Semantic HTML elements
- Proper CSS3 styling
- Responsive design with media queries
- Accessibility considerations

### Database Features
- **Foreign Key Relationships**: Proper table relationships
- **Indexes**: Performance optimization
- **Data Types**: Appropriate field types and lengths
- **Constraints**: Primary keys, unique constraints, NOT NULL
- **Sample Data**: Realistic insurance data for testing

### Responsive Design
- Mobile-first approach
- CSS Grid and Flexbox layouts
- Media queries for different screen sizes
- Touch-friendly interface elements

### Security Features
- SQL injection prevention
- XSS protection with htmlspecialchars()
- Input validation and sanitization
- Proper error handling

### Browser Compatibility
- Chrome (recommended)
- Firefox
- Safari
- Edge
- Mobile browsers

### Troubleshooting

#### Common Issues

1. **Database Connection Error**
   - Ensure MySQL is running in XAMPP
   - Check database name is `assignment1`
   - Verify username/password in PHP files

2. **Page Not Loading**
   - Check Apache is running
   - Verify file paths are correct
   - Check for PHP syntax errors

3. **No Data Displayed**
   - Ensure database is imported correctly
   - Check table names match exactly
   - Verify sample data was inserted

#### Error Logs
- Check XAMPP error logs: `C:\xampp\apache\logs\error.log`
- Check PHP error logs: `C:\xampp\php\logs\php_error_log`

### Assignment Requirements Met

✅ **Step 6: Output Dataset Content**
- Displays all data from multiple tables
- Uses loops to process database records

✅ **Step 7: Format Content**
- Beautiful HTML/CSS formatting
- W3C validation compliant
- If/Else statements for conditional formatting

✅ **Rubric Requirements**
- **Code**: Valid HTML and CSS (No W3C validation errors)
- **Well Formatted Code**: Organized, spaced, tabbed, and commented
- **Dataset**: Multiple tables with proper relationships and sample data
- **SQL**: Well-formatted queries with JOINs and proper structure
- **Dataset Design**: Responsive design with conditional formatting

### Performance Considerations
- Optimized SQL queries with proper JOINs
- Database indexes for better performance
- Efficient CSS with minimal redundancy
- Responsive images and assets

### Future Enhancements
- User authentication system
- CRUD operations for data management
- Advanced filtering and search
- Export functionality
- Real-time notifications

### Contact Information
- **Student**: [Your Name]
- **Course**: HTTP5225
- **Assignment**: 1
- **Date**: [Current Date]

---

**Note**: This project is designed for educational purposes and demonstrates web development best practices for database-driven applications. 