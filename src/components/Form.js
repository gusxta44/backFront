export default function Form() {

  const divRoot = document.getElementById('root');
  divRoot.innerHTML = '';

  const container = document.createElement('div');
  container.className = 'login-container';
  divRoot.appendChild(container);

  const titulo = document.createElement('h1');
  titulo.textContent = 'Faça seu login';
  titulo.className = 'titulo';

  const formulario = document.createElement('form');
  formulario.className = 'd-flex flex-column';

  const selectTipo = document.createElement('select');
  selectTipo.id = 'tipo-usuario';
  selectTipo.name = 'tipo-usuario';
  selectTipo.required = true;
  selectTipo.style.textAlign = 'center';
  selectTipo.style.marginBottom = '10px';
  selectTipo.style.padding = '8px';
  selectTipo.style.border = '1px solid #ccc';
  selectTipo.style.borderRadius = '4px';

  const optionCliente = document.createElement('option');
  optionCliente.value = 'cliente';
  optionCliente.textContent = 'Cliente';

  const optionFuncionario = document.createElement('option');
  optionFuncionario.value = 'funcionario';
  optionFuncionario.textContent = 'Funcionário';

  selectTipo.appendChild(optionCliente);
  selectTipo.appendChild(optionFuncionario);
  formulario.appendChild(selectTipo);
  
  const email = document.createElement('input');
  email.type = 'email';
  email.placeholder = "Digite seu email";
  formulario.appendChild(email);

  const senha = document.createElement('input');
  senha.type = 'password';
  senha.placeholder = "Digite a sua senha";
  formulario.appendChild(senha);

  const btn = document.createElement('button');
  btn.type = 'submit';
  btn.textContent = 'Entrar';
  btn.className = 'button btn-primary';
  formulario.appendChild(btn);

  container.appendChild(titulo);
  container.appendChild(formulario);
  
  return container;
} 

