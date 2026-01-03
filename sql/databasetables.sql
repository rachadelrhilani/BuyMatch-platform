CREATE database BUYMATCH;
USE BUYMATCH;
/* les tables */
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    telephone VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'organisateur', 'acheteur') NOT NULL,
    photo VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT chk_photo_mandatory CHECK (
        role = 'admin' OR photo IS NOT NULL
    )
);

CREATE TABLE equipes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    logo VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(150) NOT NULL,
    date_event DATETIME NOT NULL,
    lieu VARCHAR(150) NOT NULL,
    duree INT NOT NULL,
    statut ENUM('en_attente', 'valide', 'refuse') DEFAULT 'en_attente',

    equipe_1_id INT NOT NULL,
    equipe_2_id INT NOT NULL,

    organisateur_id INT NOT NULL,

    FOREIGN KEY (equipe_1_id) REFERENCES equipes(id),
    FOREIGN KEY (equipe_2_id) REFERENCES equipes(id),
    FOREIGN KEY (organisateur_id) REFERENCES users(id)
);
CREATE TABLE categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prix DECIMAL(10,2) NOT NULL,
    capacite INT NOT NULL DEFAULT 0,
    event_id INT NOT NULL,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE
);
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    date_commande DATETIME DEFAULT CURRENT_TIMESTAMP,
    total DECIMAL(10,2) NOT NULL,
    acheteur_id INT NOT NULL,
    FOREIGN KEY (acheteur_id) REFERENCES users(id)
);
CREATE TABLE tickets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    numero VARCHAR(100) UNIQUE NOT NULL,
    place VARCHAR(50),
    qr_code VARCHAR(255),
    order_id INT NOT NULL,
    category_id INT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (category_id) REFERENCES categories(id)
);
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    contenu TEXT NOT NULL,
    note INT CHECK (note BETWEEN 1 AND 5),
    statut ENUM('visible', 'masque') DEFAULT 'visible',
    user_id INT NOT NULL,
    event_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (event_id) REFERENCES events(id)
); 
/* insertion */
INSERT INTO users (nom, email, password, role) VALUES
('Admin Principal', 'admin@event.ma', 'hashed_admin123', 'admin'),
('Yassine Organisateur', 'orga@yallaevent.ma', 'hashed_orga123', 'organisateur'),
('Sara Acheteur', 'sara@gmail.com', 'hashed_pass123', 'acheteur'),
('Omar Acheteur', 'omar@gmail.com', 'hashed_pass456', 'acheteur');
/* équipes */
INSERT INTO equipes (nom, logo) VALUES
('Raja Club Athletic', 'raja.png'),
('Wydad Athletic Club', 'wydad.png'),
('FUS Rabat', 'fus.png'),
('AS FAR', 'asfar.png');
/* Événement sportif */
INSERT INTO events 
(titre, date_event, lieu, duree, statut, equipe_1_id, equipe_2_id, organisateur_id)
VALUES
(
    'Derby de Casablanca',
    '2025-02-20 20:00:00',
    'Stade Mohammed V',
    90,
    'valide',
    1, -- Raja
    2, -- Wydad
    2  -- Organisateur
);
/* Catégories de billets */
INSERT INTO categories (nom, prix, event_id) VALUES
('VIP', 300.00, 1),
('Tribune Centrale', 150.00, 1),
('Virage', 80.00, 1);
/* Commandes */
INSERT INTO orders (date_commande, total, acheteur_id) VALUES
(NOW(), 300.00, 3),
(NOW(), 160.00, 4);
/* ticket */
INSERT INTO tickets (numero, place, qr_code, order_id, category_id) VALUES
('TCK-001', 'A12', 'qr_001.png', 1, 1),
('TCK-002', 'B15', 'qr_002.png', 2, 3);
/* commentaires */
INSERT INTO comments (contenu, note, statut, user_id, event_id) VALUES
('Très bonne organisation, ambiance incroyable !', 5, 'visible', 3, 1),
('Match intense mais accès un peu lent.', 4, 'visible', 4, 1);