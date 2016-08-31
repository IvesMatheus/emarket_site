nome = document.getElementById("txtNome");
quantidade = document.getElementById("txtQuantidade");
peso = document.getElementById("txtPeso");
preco = document.getElementById("txtPreco");
validade = document.getElementById("txtValidade");
categoria = document.getElementById("sltCategoria");
descricao = document.getElementById("txtDescricao");
imagem = document.getElementById("imgProduto");

function btnClick(id, op)
{
    window.location = "../_phps/alterar_novo_produto.php?id=" + id + "&op=" + op;
}

function carregarVisualizador(status)
{    
    preco_correto = preco.value.replace(",", ".");

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function()
    {
        if (xhttp.readyState == 4 && xhttp.status == 200)
        {
            document.getElementById("visualizar_produto").innerHTML = xhttp.responseText;
        }
    };

    xhttp.open("POST", "../_phps/visualizar_produto.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("status="+status+"&nome=" + nome.value + "&quantidade=" + quantidade.value + "&peso=" + peso.value +     "&preco=" + preco_correto + "&validade=" + validade.value + "&categoria=" + categoria.value + "&descricao=" + descricao.value + "&imagem=" + imagem.src);
}

function btnAlterar(id)
{
    preco_correto = preco.value.replace(",", ".");

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function()
    {
        if (xhttp.readyState == 4 && xhttp.status == 200)
        {
            document.getElementById("visualizar_produto").innerHTML = xhttp.responseText;
        }
    };

    var url = "../_phps/visualizar_produto.php";

    nome.value = "";
    quantidade.value = "";
    peso.value = "";
    preco.value = "";
    validade.value = "";
    categoria.value = "";
    descricao.value = "";
    button = document.getElementById("btn_add");
    button.value = "Adicionar";
    button.onclick = carregarVisualizador(1);

    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("status=2&nome=" + nome.value + "&quantidade=" + quantidade.value + "&peso=" + peso.value + "&preco=" + preco_correto + "&validade=" + validade.value + "&categoria=" + categoria.value + "&descricao=" + descricao.value + "&imagem=null&id=" + id);
}

function carregarImagem()
{
    var btnCarregarImagem = document.getElementById("btnCarregarImagem");
    if(btnCarregarImagem.value != "")
    {
        var file = btnCarregarImagem.files[0];
        var img = document.getElementById("imgProduto");
        var reader = new FileReader();
        reader.onload = (function(aImg) {return function(e) {aImg.src = e.target.result;};})(img);
        reader.readAsDataURL(file);
    }
}

function btnCancelar()
{
    window.location = "../_phps/cancelar_alt_produto.php";
}
