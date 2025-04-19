-- --------------------------------------------------
-- Database: tawssil
-- --------------------------------------------------

-- Table: Configuration
CREATE TABLE IF NOT EXISTS Configuration (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nbVueAnnonce INT,
    nbVueNews INT,
    Styles TEXT,
    criteresSelection TEXT,
    diaporamaSettings TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Table: Annonce
CREATE TABLE IF NOT EXISTS Annonce (
    idAnnonce INT AUTO_INCREMENT PRIMARY KEY,
    ptDepart VARCHAR(255) NOT NULL,
    ptArrivee VARCHAR(255) NOT NULL,
    typeTrasnport VARCHAR(100) NOT NULL,
    poids DECIMAL(10,2),
    volume DECIMAL(10,2),
    moyenTransport VARCHAR(100),
    tarif DECIMAL(10,2),
    user INT,  -- reference to Profile.id
    confirmee TINYINT(1) DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user) REFERENCES Profile(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Table: News
CREATE TABLE IF NOT EXISTS News (
    id INT AUTO_INCREMENT PRIMARY KEY,
    images VARCHAR(255),
    text TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Table: Contact
CREATE TABLE IF NOT EXISTS Contact (
    idContact INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255),
    telephone VARCHAR(50),
    adresse TEXT,
    message TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Table: Presentation
CREATE TABLE IF NOT EXISTS Presentation (
    idPresentation INT AUTO_INCREMENT PRIMARY KEY,
    lien VARCHAR(255),
    objectifsText TEXT,
    fonctionnementText TEXT,
    video VARCHAR(255)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Table: Profile
CREATE TABLE IF NOT EXISTS Profile (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    tel VARCHAR(20),
    addresse VARCHAR(255),
    mdp VARCHAR(255) NOT NULL,
    type VARCHAR(50),     -- e.g., 'client' or 'transporteur'
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Table: TransporteurProfile
-- This table extends Profile for transporters with extra information.
CREATE TABLE IF NOT EXISTS TransporteurProfile (
    profile_id INT PRIMARY KEY,
    trajets TEXT,         -- Could be a JSON string or text listing routes (modify as needed)
    certificat TINYINT(1) DEFAULT 0,  -- flag indicating if transporter has certification
    FOREIGN KEY (profile_id) REFERENCES Profile(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Table: Certificat
-- Details about certification for transporters.
CREATE TABLE IF NOT EXISTS Certificat (
    id INT AUTO_INCREMENT PRIMARY KEY,
    profile_id INT,
    etat VARCHAR(50),     -- certification status e.g., "pending", "approved", "rejected"
    documents TEXT,       -- links or file identifiers to documents
    reponse TEXT,         -- admin response or justification
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (profile_id) REFERENCES TransporteurProfile(profile_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Table: Signalement
-- Records of reports between users.
CREATE TABLE IF NOT EXISTS Signalement (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reporter_id INT,
    reported_id INT,
    annonce_id INT,
    texte TEXT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (reporter_id) REFERENCES Profile(id) ON DELETE CASCADE,
    FOREIGN KEY (reported_id) REFERENCES Profile(id) ON DELETE CASCADE,
    FOREIGN KEY (annonce_id) REFERENCES Annonce(idAnnonce) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Table: Transaction
-- Stores transaction details between a client and a transporter.
CREATE TABLE IF NOT EXISTS Transaction (
    id INT AUTO_INCREMENT PRIMARY KEY,
    annonce_id INT,
    transporteur_id INT,
    client_id INT,
    status VARCHAR(50) DEFAULT 'pending',  -- e.g., pending, confirmed, cancelled
    dateTransaction DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (annonce_id) REFERENCES Annonce(idAnnonce) ON DELETE CASCADE,
    FOREIGN KEY (transporteur_id) REFERENCES Profile(id) ON DELETE CASCADE,
    FOREIGN KEY (client_id) REFERENCES Profile(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- Table: Trajet
-- Stores route details for transporter profiles.
CREATE TABLE IF NOT EXISTS Trajet (
    id INT AUTO_INCREMENT PRIMARY KEY,
    profile_id INT,  -- transporter profile id
    depart VARCHAR(255),
    arrivee VARCHAR(255),
    FOREIGN KEY (profile_id) REFERENCES TransporteurProfile(profile_id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
