export default function DateSelector() {
  const dataSelect = document.createElement('div');
  dataSelect.classList.add('date-selector'); // só para estilizar 

  const inputEntrada = document.createElement('input');
  inputEntrada.type = 'text';
  inputEntrada.name = 'checkin';
  inputEntrada.placeholder = 'Data de check-in';

  const inputSaida = document.createElement('input');
  inputSaida.type = 'text';
  inputSaida.name = 'checkout';
  inputSaida.placeholder = 'Data de check-out';

  const btnPesquisar = document.createElement('button');
  btnPesquisar.textContent = 'Pesquisar';
  btnPesquisar.classList.add('btn-pesquisar');

  dataSelect.appendChild(inputEntrada);
  dataSelect.appendChild(inputSaida);
  dataSelect.appendChild(btnPesquisar);

  return dataSelect;
}
