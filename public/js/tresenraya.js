const cells = document.querySelectorAll(".cell");
const statusText = document.getElementById("status");
const resetBtn = document.getElementById("reset");

let currentPlayer = "X";
let board = ["", "", "", "", "", "", "", "", ""];
let running = true;

const winConditions = [
  [0,1,2], [3,4,5], [6,7,8],
  [0,3,6], [1,4,7], [2,5,8],
  [0,4,8], [2,4,6]
];

cells.forEach(cell => cell.addEventListener("click", cellClicked));
resetBtn.addEventListener("click", resetGame);

function cellClicked() {
  const index = this.dataset.index;
  if (board[index] !== "" || !running) return;
  board[index] = currentPlayer;
  this.textContent = currentPlayer;
  checkWinner();
}

function checkWinner() {
  let roundWon = false;
  for (let condition of winConditions) {
    const [a, b, c] = condition;
    if (board[a] && board[a] === board[b] && board[a] === board[c]) {
      roundWon = true;
      break;
    }
  }

  if (roundWon) {
    statusText.textContent = `Jugador ${currentPlayer} gana!`;
    running = false;
    // NUEVO: registramos una victoria (puntaje = 1) para el jugador logueado
    guardarPuntaje(JUEGO_ID, 1);
  } else if (!board.includes("")) {
    statusText.textContent = "Empate!";
    running = false;
  } else {
    currentPlayer = currentPlayer === "X" ? "O" : "X";
    statusText.textContent = `Turno de ${currentPlayer}`;
  }
}

function resetGame() {
  currentPlayer = "X";
  board = ["", "", "", "", "", "", "", "", ""];
  statusText.textContent = "Turno de X";
  cells.forEach(cell => { cell.textContent = ""; });
  running = true;
  document.getElementById("aviso_puntaje").textContent = "";
}
