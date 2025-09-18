import DateSelector from "../components/DateSelector.js";
import Footer from "../components/Footer.js";
import Hero from"../components/Hero.js";
import Navbar from "../components/Navbar.js";
import RoomCards from "../components/RoomCards.js";

export default function renderHomePage() {

    const nav = document.getElementById('navbar');
    nav.innerHTML = "";
  
    const navbar = Navbar();
    nav.appendChild(navbar);  

    const home = document.getElementById('root');
    home.innerHTML = "";

    const hero = Hero();
    home.appendChild(hero);

    const rodape = document.getElementById('footer');
    rodape.innerHTML = "";

    const Ft = Footer();
    rodape.appendChild(Ft);

    const dataSelect = document.getElementById('date-selector');
    dataSelect.innerHTML = "";

    const dateSelector = DateSelector();
    dataSelect.appendChild(dateSelector);

    const cardQuarto = document.getElementById('roomcards');
    cardQuarto.className = "cards";
    cardQuarto.innerHTML = "";

    for (var i=0; i < 5; i++) {
        const cardq = RoomCards();
    cardQuarto.appendChild(cardq);
    }

    

    
 
    

}