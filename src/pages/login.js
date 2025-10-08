import { loginRequest, saveToken } from "../api/authApi.js";
import Form from "../components/Form.js";
import Navbar from "../components/Navbar.js";
import Footer from "../components/Footer.js";

export default function renderLoginPage() {
    const nav = document.getElementById('navbar');
    nav.innerHTML = "";

    const navbar = Navbar();
    nav.appendChild(navbar);

    const formulario = Form();
    const contentForm = formulario.querySelector('form');

    //Inputs e botão presentes no form
    const inputEmail = contentForm.querySelector('input[type="email"]');
    const inputSenha = contentForm.querySelector('input[type="password"]');
    // const btn = contentForm.querySelector('button[type="submit"]');

    //Monitora o clique no botão para acionar um evento de submeter os dados do form
    contentForm.addEventListener("submit", async (e) => {
        e.preventDefault();
        const email = inputEmail.value.trim();
        const senha = inputSenha.value.trim();
   
        try{
            const result = await loginRequest(email, senha);
            saveToken(result.token);
            //window.location.pathname = '/MeuSite/home';
        } 
        catch (error) {
            console.error("Erro durante login:", error);
        }
    });

    const signupLink = document.createElement('a');
    signupLink.innerHTML = `Não possui uma conta? Cadastre-se`;
    signupLink.style.textAlign = 'center';
    signupLink.style.marginTop = '20px';
    signupLink.href = 'cadastro';
 
    contentForm.appendChild(signupLink);
    
    const rodape = document.getElementById('footer');
    rodape.innerHTML = "";
    
    const Ft = Footer();
    rodape.appendChild(Ft);

   }

 
