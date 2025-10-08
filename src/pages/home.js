import { listAvailableRoomsRequest } from "../api/roomsAPI.js";
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
 
    const [dateCheckIn, dateCheckOut] = datesSelector.querySelectorAll('input[type="date"]');
    const guestAmount = datesSelector.querySelector('select');
    const btnSearchRoom = datesSelector.querySelector('button');
   
    btnSearchRoom.addEventListener("click", async (e) => {
        e.preventDefault();

        const inicio = (dateCheckIn?.value || "").trim();
        const fim = (dateCheckOut?.value || "").trim();
        const capacidade = parseInt(guestAmount?.value || "0", 10);

        //validação do preenchimento de infos
        if (!inicio || !fim || Number.isNaN(capacidade) || capacidade <= 0) {
            console.log("preencha todos os campos!");
            /*tarefa 1: renderizar nesse if() posteriormente um modal do bootstrap
            https://getbootstrap.com/docs/5.3/components/modal/*/
            return;
        }

        /*OBS: falta impedir que o usuário pesquise por uma data passada*/
        const dtInicio = new Date(inicio);
        const dtFim = new Date(fim);

        if (isNaN(dtInicio) || isNaN(dtFim) || dtInicio >= dtFim) {
            console.log("a data de check-out deve ser posterior ao check-in!");
            /*tarefa 2: renderizar nesse if() posteriormente um modal do bootstrap!
            https://getbootstrap.com/docs/5.3/components/modal/*/
            return;
        }

        console.log("buscando quartos disponíveis");
        /*tarefa 3: renderizar na tela um símbolo de loading (spinner do bootstrap)
        https://getbootstrap.com/docs/5.3/components/spinners*/


        try {
            const result = await listAvailableRoomsRequest({inicio, fim, capacidade});
            if (!result.length) {
                console.log("nenhum quarto disponível para esse período");
                /*tarefa 4: renderizar nesse if() posteriormente um modal do bootstrap
                https://getbootstrap.com/docs/5.3/components/modal*/
                return;
            }
            cardQuarto.innerHTML = '';
            result.forEach((itemCard, i) => {
                cardQuarto.appendChild(RoomCards(itemCard, i));
            });
        } 
        catch(error) {
            console.log(error);
        }
    });

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
 