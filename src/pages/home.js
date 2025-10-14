import { listAvailableRoomsRequest } from "../api/roomsAPI.js";
import DateSelector from "../components/DateSelector.js";
import Footer from "../components/Footer.js";
import Hero from "../components/Hero.js";
import Navbar from "../components/Navbar.js";
import RoomCards from "../components/RoomCards.js";
import CardLounge from "../components/CardLounge.js";

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

  const cardQuarto = document.createElement('div');
  cardQuarto.className = "cards";
  divRoot.appendChild(cardQuarto);

  const loungeContainer = document.createElement('div');
  loungeContainer.className = "cards lounge-cards";

  const loungeTitle = document.createElement('h2');
  loungeTitle.textContent = 'Conheça nosso hotel';
  loungeTitle.className = 'text-center my-4'; 
  divRoot.appendChild(loungeTitle);

  const loungeItems = [
    { path: "restaurante.jpg", title: "Restaurante", text: "Nosso restaurante é um espaço agradável e familiar!" },
    { path: "Sauna.jpg", title: "SPA", text: "Nosso SPA é ideal para momentos de relaxamento!" },
    { path: "infantil.jpg", title: "Área para crianças", text: "Temos o melhor espaço para crianças, curta enquanto suas crianças!" },
    { path: "academia.jpg", title: "Academia", text: "Temos uma academia incrivel, com aparelhos de última geração" }
  ];

  loungeItems.forEach((item, i) => {
    loungeContainer.appendChild(CardLounge(item, i));
  });

  divRoot.appendChild(loungeContainer);

  const [dateCheckIn, dateCheckOut] = datesSelector.querySelectorAll('input[type="date"]');

  const hoje = new Date().toISOString().split('T')[0];
  dateCheckIn.setAttribute('min', hoje);
  dateCheckOut.setAttribute('min', dateCheckIn);

  dateCheckIn.addEventListener('change', () => {
    if (dateCheckIn.value) {
    const dataCheckin = new Date(dateCheckIn.value);
    dataCheckin.setDate(dataCheckin.getDate() + 1);

    const novaMinCheckout = dataCheckin.toISOString().split('T')[0];
    dateCheckOut.setAttribute('min', novaMinCheckout);
  }
  });

  const guestAmount = datesSelector.querySelector('select');
  const btnSearchRoom = datesSelector.querySelector('button'); 
  const msgdeErro = datesSelector.querySelector('.mensagem-erro');

  btnSearchRoom.addEventListener("click", async (e) => {
    e.preventDefault();

    const inicio = (dateCheckIn?.value || "").trim();
    const fim = (dateCheckOut?.value || "").trim();
    const capacidade = parseInt(guestAmount?.value || "0", 10);
    const hoje = new Date();
    hoje.setHours(0,0,0,0); 

    const errors = [];

    dateCheckIn.classList.remove('input-error');
    dateCheckOut.classList.remove('input-error');
    guestAmount.classList.remove('input-error');

    if (!inicio) {
        errors.push("data de check in é obrigatória");
        dateCheckIn.classList.add('input-error');
    }

    if (!fim) {
        errors.push("data de check out é obrigatória");
        dateCheckOut.classList.add('input-error');
    }

    if (Number.isNaN(capacidade) || capacidade <= 0) {
        errors.push("ué, quantas pessoas vao usar fi? vc nao colocou");
        guestAmount.classList.add('input-error');
    }

    const dataInicio = new Date(inicio);
    const dataFim = new Date(fim);

    if (inicio && fim && (!isNaN(dataInicio) && !isNaN(dataFim)) && dataInicio >= dataFim) {
        errors.push("a data de check out deve ser posterior ao check in");
        dateCheckIn.classList.add('input-error');
        dateCheckOut.classList.add('input-error');
    }

    if (errors.length > 0) {
      msgdeErro.innerHTML = '';
      errors.forEach(msg => {
        const li = document.createElement('li');
        li.textContent = msg;
        msgdeErro.appendChild(li);
      });
      msgdeErro.style.display = 'block';
      return;
    }
    msgdeErro.innerHTML = '';
    msgdeErro.style.display = 'none';

    dateCheckIn.classList.remove('input-error');
    dateCheckOut.classList.remove('input-error');
    guestAmount.classList.remove('input-error');

    console.log("buscando quartos disponíveis");

    try {
      const result = await listAvailableRoomsRequest({inicio, fim, capacidade});
      if (!result.length) {
        console.log("nenhum quarto disponível pra essa data");
        return;
      }
      cardQuarto.innerHTML = '';
      result.forEach((itemCard, i) => {
        cardQuarto.appendChild(RoomCards(itemCard, i));
      });
    } catch (error) {
      console.log(error);
    }
  });

  const footer = document.getElementById('footer');
  footer.innerHTML = '';

  const footers = Footer();
  footer.appendChild(footers);
}
