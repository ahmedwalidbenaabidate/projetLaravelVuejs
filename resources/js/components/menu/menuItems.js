const navMenu = 
    [
        /* J'ai ajouter type:to et type:... pour résoudre le probléme de la page d'accueil pour l'actualisé pour
        résoudre le probléme de résolution des charts c'est une solution provisoire le changement a été fait
        au niveau du component "Sidebar-menu-akahon.vue" dans le répertoire "node_modules" */
        {link: '/Accueil',name: 'Accueil', tooltip: 'Accueil', icon: 'bx-home',type:"link" },
        {link: '/administratifs',name: 'Administratif', tooltip: 'Administratif', icon: 'bx-briefcase-alt-2',type:"to" },
        {link: '/employees',name: 'Employés', tooltip: 'Employés', icon: 'bx-group',type:"to" },
        {link: '/qualites',name: 'Qualités Employés', tooltip: 'Qualités Employés', icon: 'bx-id-card',type:"to" },
        {link: '/materiels',name: 'Matériels', tooltip: 'Matériels', icon: 'bx-wrench',type:"to" },
        {link: '/typemarteriels',name: 'Type matériels', tooltip: 'Type matériels', icon: 'bx-category-alt',type:"to" },
        {link: '/carburants',name: 'Carburant', tooltip: 'Carburant', icon: 'bx-gas-pump',type:"to" },
        {link: '/depenses',name: 'Dépenses', tooltip: 'Dépenses', icon: 'bx-money',type:"to" },
        {link: '/pointages',name: 'Pointage employés', tooltip: 'Pointage employés', icon: 'bx-user-check',type:"to" },
        {link: '/affectationMateriels',name: 'Pointage matériels', tooltip: 'Pointage matériels',type:"to", icon: 'bx-spreadsheet' },
        {link: '/accidents',name: 'Accidents', tooltip: 'Accidents', icon: 'bx-traffic-cone',type:"to" },
        {link: '/chantiers',name: 'Chantiers', tooltip: 'Chantiers', icon: 'bx-buildings',type:"to" },
        {link: '/users',name: 'Utilisateurs', tooltip: 'Utilisateurs', icon: 'bx-user-circle',type:"to" },
    ]


export default navMenu;