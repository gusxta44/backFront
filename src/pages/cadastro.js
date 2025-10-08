import Form from"../components/Form.js";
import Navbar from "../components/Navbar.js";
import Footer from "../components/Footer.js";

export default function renderCadastroPage() {

    const nav = document.getElementById('navbar');
    nav.innerHTML = "";

    const navbar = Navbar();
    nav.appendChild(navbar);

    const formulario = Form();

    const titulo = formulario.querySelector('h1');
    titulo.textContent = "Cadastre-se";
    titulo.className = 'titulo';

    const contentForm = formulario.querySelector('form');

    const nome = document.createElement('input');
    nome.type = 'text';
    nome.placeholder = "Digite seu nome";

    const inputEmail = formulario.querySelector('input[type="email"]');
    contentForm.insertBefore(nome, inputEmail);

    const confSenha = document.createElement('input');
    confSenha.type = 'password';
    confSenha.placeholder = "Confirme sua senha";
    contentForm.insertBefore(confSenha, contentForm.children[3]);

    const btnRegister = formulario.querySelector('button');
    btnRegister.textContent = "Cadastre-se";

    const rodape = document.getElementById('footer');
    rodape.innerHTML = "";

    const Ft = Footer();
    rodape.appendChild(Ft);
    
} 