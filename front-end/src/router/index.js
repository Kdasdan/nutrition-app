import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);
// Site
import Site from '../views/Site';
import Accueil from '../components/site/contenue/accueil/Accueil';
import Recettes from '../components/site/contenue/recettes/Recettes';
import RecettesSaison from '../components/site/contenue/recettes/RecettesSaison';
import Tarifs from '../components/site/contenue/tarifs/Tarifs';
import Contact from '../components/site/contenue/contact/Contact';

// Login
import Login from '../views/Login';
import Connect from '../components/login/Connect';
import Reinit from '../components/login/ConnectReinit';

// Application
// admin
import Application from '../views/Application';
import AccueilAppli from '../components/application/contenu/AccueilAppli';
import GestionAdmin from '../components/application/contenu/admin/gestion/Gestion';
import PatientsAdmin from '../components/application/contenu/admin/patients/Patients';
// client
import BilanClient from '../components/application/contenu/client/bilan/Bilan';
import CourbeClient from '../components/application/contenu/client/courbe/Courbe';
import MessagerieClient from '../components/application/contenu/client/messagerie/Messagerie';
import RecettesClient from '../components/application/contenu/client/recettes/Recettes';

const routes = [
  // site
  {
    path: '/',
    component: Site,
    children: [
      { path: '/', component: Accueil },
      { path: '/recettes', component: Recettes },
      { path: '/recettes-saison/:saison', component: RecettesSaison },
      { path: '/tarifs', component: Tarifs },
      { path: '/contact', component: Contact }
    ]
  },
  // login
  {
    path: '/connexion',
    component: Login,
    children: [
      { path: '/connexion', component: Connect },
      { path: '/reinitialisation/:id', component: Reinit }
    ]
  },
  // Application
  {
    path: '/dashboard',
    component: Application,
    children: [
      // admin
      { path: '/dashboard', component: AccueilAppli },
      { path: 'gestion', component: GestionAdmin },
      { path: 'patients', component: PatientsAdmin },
      // client
      { path: 'bilan', component: BilanClient },
      { path: 'courbe', component: CourbeClient },
      { path: 'messagerie', component: MessagerieClient },
      { path: 'recettes', component: RecettesClient }
    ]
  }
];

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
});

export default router;
