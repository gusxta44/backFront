import DateSelector from "../components/DateSelector.js";
import Footer from "../components/Footer.js";
import Hero from"../components/Hero.js";
import Navbar from "../components/Navbar.js";
import RoomCards from "../components/RoomCards.js";
 
export default function renderHomePage() {
 
    const nav = document.getElementById('navbar');
    nav.innerHTML = '';
       
    const navbar = Navbar();
    nav.appendChild(navbar);
 
    const divRoot = document.getElementById('root');
    divRoot.innerHTML = '';
   
    const hero = Hero();
    divRoot.appendChild(hero);
 
    const datesSelector = DateSelector();
    divRoot.appendChild(datesSelector);
 
    const cardQuarto = document.getElementById('roomcards');
    cardQuarto.className = "cards";
    cardQuarto.innerHTML = "";
 
    for (var i=0; i < 3; i++) {
    const cardq = RoomCards(i);
    cardQuarto.appendChild(cardq);
    }

    divRoot.appendChild(cardQuarto);
 
    const footer = document.getElementById('footer');
    footer.innerHTML = '';
 
    const footers = Footer();
    footer.appendChild(footers);
   
}
 