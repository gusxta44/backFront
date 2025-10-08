export default function DateSelector() {
  const divDate = document.createElement('div');
  divDate.className = 'dateSelector';

  const dateCheckIn = document.createElement('input');
  dateCheckIn.type = 'date';
  dateCheckIn.className = 'card p-3 shadow-lg inputDate';

  const dateCheckOut = document.createElement('input');
  dateCheckOut.type = 'date';
  dateCheckOut.className = 'card p-3 shadow-lg inputDate';

  const guestAmount = document.createElement('select');
  guestAmount.className = 'inputDate card p-3 shadow-lg';
  guestAmount.innerHTML = `
    <option value="">Quantas Pessoas?</option>
    <option value="1">1 pessoa</option>
    <option value="2">2 pessoas</option>
    <option value="3">3 pessoas</option>
    <option value="4">4 pessoas</option>
    <option value="5">5 ou mais pessoas</option>
  `;

  const btnSearchRoom = document.createElement('button');
  btnSearchRoom.type = 'submit';
  btnSearchRoom.textContent = 'Pesquisar';
  btnSearchRoom.className = 'btn'

  const modal = document.createElement('div');
  modal.className = 'modalAviso';  
  modal.style.display = 'none';

  divDate.appendChild(dateCheckIn);
  divDate.appendChild(dateCheckOut);
  divDate.appendChild(guestAmount);
  divDate.appendChild(btnSearchRoom);

  return divDate;
}
