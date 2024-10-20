<?php
// Database connection
$host = 'localhost';
$db = 'courses_db';
$user = 'root'; // default username for XAMPP
$pass = ''; // default password for XAMPP

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Fetch courses from the database
$courses = [];
try {
    $stmt = $conn->query("SELECT * FROM courses");
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching courses: " . $e->getMessage();
}

// Handle contact form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);
    
    echo "<script>alert('Thank you, $name! Your message has been sent.');</script>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programming Language Courses</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Programming Language Courses</h1>
        <nav>
            <ul>
                <li><a href="#home">Home</a></li>
                <li><a href="#courses">Courses</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="home">
            <h2>Welcome to Our Courses</h2>
            <p>Learn programming languages from scratch or enhance your skills with our curated courses.</p>
        </section>

        <section id="courses">
            <h2>Available Courses</h2>
            <?php foreach ($courses as $course): ?>
                <div class="course">
                    <h3><?php echo $course['title']; ?></h3>
                    <p><?php echo $course['description']; ?></p>
                    <button onclick="alert('You have enrolled in <?php echo $course['title']; ?>!')">Enroll Now</button>
                </div>
            <?php endforeach; ?>
        </section>

        <section id="contact">
            <h2>Contact Us</h2>
            <form method="post">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Message" required></textarea>
                <button type="submit" name="contact_submit">Send Message</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2024 Programming Courses. All rights reserved.</p>
    </footer>
</body>
</html>
