# 🌟 VoidBound - Game Library Management System

A modern, responsive web application for managing your video game collection. Built with PHP and MySQL, this system provides a comprehensive CRUD (Create, Read, Update, Delete) interface for game management.

## ✨ Key Features

- 🎮 **Game Management**
  - Add new games with detailed information
  - View comprehensive game details
  - Edit existing game information
  - Delete games from the library
  
- 🔍 **Advanced Search & Filtering**
  - Search across multiple fields (title, developer, platform, etc.)
  - Filter games by genre
  - Filter games by platform
  - Responsive search interface
  
- 📱 **User Interface**
  - Clean and modern design
  - Responsive layout for all devices
  - Intuitive navigation
  - Interactive data tables
  - Form validation and error handling

## 🛠️ Technical Stack

- **Backend:** PHP 7.0+
- **Database:** MySQL/MariaDB
- **Frontend:** HTML5, CSS3, JavaScript
- **Server:** Apache/XAMPP
- **Additional:** PDO for database operations

## 📋 Database Schema

The application uses a single table `games` with the following structure:

```sql
CREATE TABLE games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    developer VARCHAR(255) NOT NULL,
    publisher VARCHAR(255),
    release_date DATE,
    genre ENUM('Action', 'Adventure', 'RPG', 'Strategy', 'Sports', 'Puzzle', 'Other'),
    platform ENUM('PC', 'PlayStation', 'Xbox', 'Nintendo Switch', 'Mobile', 'Other'),
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### 📝 Field Descriptions

- `id`: Unique identifier for each game
- `title`: Name of the game (required)
- `developer`: Company/individual that developed the game (required)
- `publisher`: Publishing company (optional)
- `release_date`: Game's release date (optional)
- `genre`: Game category (predefined options available)
- `platform`: Gaming platform (predefined options available)
- `description`: Detailed game description (optional)
- `created_at`: Record creation timestamp
- `updated_at`: Last modification timestamp

## 🚀 Installation

1. **Prerequisites**
   - PHP 7.0 or higher
   - MySQL/MariaDB
   - XAMPP, WAMP, or similar PHP development environment
   - Web browser

2. **Database Setup**
   ```bash
   # Import the schema
   mysql -u root -p < schema.sql
   ```

3. **Application Setup**
   - Clone the repository to your web server directory:
     ```bash
     git clone [your-repository-url]
     ```
   - Configure database connection in `db.php`:
     ```php
     $host = 'localhost';
     $dbname = 'game_library';
     $username = 'your_username';
     $password = 'your_password';
     ```

4. **Access the Application**
   - Open your web browser
   - Navigate to: `http://localhost/[project-folder-name]`

## 💻 Usage Guide

1. **Adding a Game**
   - Click "Add New Game" button
   - Fill in the required fields (Title, Developer)
   - Add optional information as needed
   - Click "Add Game" to save

2. **Viewing Games**
   - Browse the main page for all games
   - Click on any game row to view details
   - Use search and filters to find specific games

3. **Editing Games**
   - Click on a game to view details
   - Click "Edit Game" button
   - Modify the information
   - Click "Update Game" to save changes

4. **Deleting Games**
   - Click on a game to view details
   - Click "Delete Game" button
   - Confirm the deletion

## 🔒 Security Features

- PDO prepared statements for SQL injection prevention
- Input validation and sanitization
- XSS protection through `htmlspecialchars()`
- Secure database configuration

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📝 License

This project is open source and available under the [MIT License](LICENSE).

## 👤 Author

Created with ❤️ by Shaiyon

---
⭐️ If you found this project helpful, please give it a star! 
