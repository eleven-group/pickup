export const translations = {
    resources: {
        products: {
            name: 'Produit |||| Produits',
            fields: {
                id: 'Numéro produit',
                quantity: 'Quantité',
                name: 'Nom',
                description: 'Description',
                imageUrl: 'URL de l\'image du produit',
                price: 'Prix'
            },
        },
        users: {
            name: 'Utilisateur |||| Utilisateurs',
            fields: {
                id: 'ID Utilisateur',
                username: 'Nom d\'utilisateur',
                firstname: 'Prénom',
                lastname: 'Nom de famille',
                email: 'E-mail',
                isActive: 'Utilisateur actif'
            },
        },
        bookings: {
            name: 'Commande |||| Commandes',
            fields: {
                id: 'Numéro de commande',
                status: 'Statut',
                date: 'Date',
                firstname: 'Prénom du client',
                lastname: 'Nom du client',
                phonenumber: 'Tél. du client',
                email: 'E-mail du client',
                bookingItems: 'Produits commandés',
            }
        },
        bookingItems: {
            name: 'Produit commandé |||| Produits commandés',
            fields: {
                quantity: 'Quantité commandée',
                product: 'Produit commandée',
            }
        },
        shops: {
            name: 'Magasin |||| Magasins',
            fields: {
                name: 'Nom de l\'enseigne',
                description: 'Description',
                streetAddress: 'Rue',
                city: 'Ville',
                postalCode: 'Code Postal',
                openingHours: 'Horraires d\'ouvertures',
                owner: 'Manager',
            }
        },
    },
};
