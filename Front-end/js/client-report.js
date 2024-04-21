function downloadPDF() {
  const { jsPDF } = window.jspdf;
  const doc = new jsPDF();

  doc.text("Relatório de Clientes", 105, 10, null, null, 'center');

  // Adicionar cabeçalhos de coluna
  doc.setFontSize(11);
  doc.text(20, 30, "ID do Cliente");
  doc.text(70, 30, "Nome");
  doc.text(120, 30, "Compras");

  // Adicionar alguns dados de exemplo
  doc.text(20, 40, "001");
  doc.text(70, 40, "João Silva");
  doc.text(120, 40, "15");

  // Adicionar mais linhas aqui como necessário
  // doc.text(x, y, "Texto");

  // Salva o PDF
  doc.save("relatorio-clientes.pdf");
}
