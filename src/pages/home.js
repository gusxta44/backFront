import Hero from"../components/Hero.js";
import Navbar from "../components/Navbar.js";

export default function renderHomePage() {

    const nav = document.getElementById('navbar');
    nav.innerHTML = "";
  
    const navbar = Navbar();
    nav.appendChild(navbar);  

    const home = document.getElementById('root');
    home.innerHTML = "";

    const hero = Hero();
    home.appendChild(hero);
}