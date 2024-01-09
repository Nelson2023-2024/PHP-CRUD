CREATE TABLE clients(

    id INT NOT NULL UNSIGNED PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NULL,
    address VARCHAR(200) NULL,
    created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO clients(name, email, phone, address) VALUES
('Bill Gates', 'bill@microsoft.com', '+265367938572', 'New York USA'),
('Elon Musk', 'musk@tesla.com', '+265986471205', 'Florida USA'),
('Will Smith', 'will@gmail.com', '+265457760923', 'Califonia USA'),
('Bob Marley', 'bob@gmail.com', "+276943124567", 'Cairo Egypt'),
('Cristiano Ronaldo', 'CR7@gmail.com', "+276944164066", 'Sauidi Arabia AlNasser'),
('Joe Biden', 'joe@gmail.com', '+265123900987', "WashingtonDC USA");