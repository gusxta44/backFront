import Form from "../components/Form.js";
import Navbar from "../components/Navbar.js";
import Footer from "../components/Footer.js";
import {addRoom} from "../api/roomsAPI.js";

export default function renderRoomPage() {
    const nav = document.getElementById('navbar');
    nav.innerHTML = '';
    nav.appendChild(Navbar());

    const container = Form();
    container.classList.add('room-form');

    const form = container.querySelector('form');

    const titulo = container.querySelector('h1');
    titulo.textContent = "Cadastro Quarto";

    const emailInput = form.querySelector('input[type="email"]');
    if (emailInput) emailInput.remove();
    const senhaInput = form.querySelector('input[type="password"]');
    if (senhaInput) senhaInput.remove();

    const btn = form.querySelector('button');
    btn.textContent = 'Cadastrar Quarto';

    const inputNome = document.createElement('input');
    inputNome.type = 'text';
    inputNome.placeholder = "Nome do quarto";
    inputNome.name = "nome";
    form.insertBefore(inputNome, btn);

    const inputNumero = document.createElement('input');
    inputNumero.type = 'text';
    inputNumero.placeholder = "Número do quarto";
    inputNumero.name = "numero";
    form.insertBefore(inputNumero, btn);

    const inputCamaCasal = document.createElement('input');
    inputCamaCasal.type = 'number';
    inputCamaCasal.placeholder = "Quantidade de camas de casal";
    inputCamaCasal.min = 0;
    inputCamaCasal.name = "qnt_cama_casal";
    form.insertBefore(inputCamaCasal, btn);

    const inputCamaSolteiro = document.createElement('input');
    inputCamaSolteiro.type = 'number';
    inputCamaSolteiro.placeholder = "Quantidade de camas de solteiro";
    inputCamaSolteiro.min = 0;
    inputCamaSolteiro.name = "qnt_cama_solteiro";
    form.insertBefore(inputCamaSolteiro, btn);

    const inputPreco = document.createElement('input');
    inputPreco.type = 'number';
    inputPreco.placeholder = "Valor da diária";
    inputPreco.min = 0;
    inputPreco.step = 0.01;
    inputPreco.name = "preco";
    form.insertBefore(inputPreco, btn);

    const inputFotos = document.createElement('input');
    inputFotos.name = 'fotos[]';
    inputFotos.type = 'file';
    inputFotos.multiple = true;
    inputFotos.id = 'formFileMultiple';
    inputFotos.className = 'form-control';
    inputFotos.accept = 'image/*';
    form.insertBefore(inputFotos, btn);

    const selectDisponivel = document.createElement('select');
    selectDisponivel.name = 'disponivel';
    selectDisponivel.className = 'form-select';

    const optionDefault = document.createElement('option');
    optionDefault.textContent = 'Disponibilidade';
    optionDefault.value = '';
    optionDefault.disabled = true;
    optionDefault.selected = true;
    selectDisponivel.appendChild(optionDefault);

    const optionSim = document.createElement('option');
    optionSim.textContent = 'Sim';
    optionSim.value = 'true';
    selectDisponivel.appendChild(optionSim);

    const optionNao = document.createElement('option');
    optionNao.textContent = 'Não';
    optionNao.value = 'false';
    selectDisponivel.appendChild(optionNao);
    form.insertBefore(selectDisponivel, btn);
    
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        try { 
            const response = await addRoom(form);
            console.log("Resposta do servidor: ", response);
        }
        catch (error) {
            console.log("Erro ao enviar requisição: " + error.message);
        }
    });

    const divRoot = document.getElementById('root');
    divRoot.innerHTML = '';
    divRoot.appendChild(container);

    const footer = document.getElementById('footer');
    footer.innerHTML = '';
    footer.appendChild(Footer());
}
