function downloadPDF() {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();

  // Título do documento PDF
  doc.text("Relatório de Clientes", 105, 10, null, null, 'center');

  // Cabeçalhos da tabela
  const headers = ["ID do Cliente", "Nome", "Compras"];

  // Montando os dados da tabela
  let rows = [];
  const table = document.getElementById("tabelaUsuarios").getElementsByTagName("tbody")[0];
  const trs = table.getElementsByTagName("tr");

  for (let tr of trs) {
    const tds = tr.getElementsByTagName("td");
    let row = [];
    for (let td of tds) {
      row.push(td.innerText);
    }
    rows.push(row);
  }

  // Adicionar a tabela ao PDF
  doc.autoTable({
    head: [headers],
    body: rows,
    startY: 20,
    theme: 'grid',
    headStyles: { fillColor: [64, 91, 57] }, // Cor de fundo dos cabeçalhos
    styles: { font: 'courier', fontSize: 11 }
  });

  // Salva o PDF
  doc.save("relatorio-clientes.pdf");
}
