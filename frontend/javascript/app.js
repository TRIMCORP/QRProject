$('#btnsend').click((e)=>{

	e.preventDefault();

	let nome = $('#nome');
	let cpf = $('#cpf');
	let email = $('#email');
	let telefone = $('#telefone');
	console.log(nome.val(), cpf.val(), email.val(), telefone.val());

	if (nome.val().length < 2 || cpf.val().length < 11 || email.val().length < 5 || telefone.val().length < 11) {
		alert('Digite nos campos corretamente');
	}else{
		$("#p").append('body');
	$.ajax({
		method: 'POST',
		url: 'http://localhost/QRProject/backend/sendData.php',
		data: {nome: nome.val(), cpf: cpf.val(), email: email.val(), telefone: telefone.val()},
		cache: false,
		dataType: 'html',
		success: function(req){
			$("#p").empty();
			console.log('certo')
			console.log(req)
			  //this.blur(); // Manually remove focus from clicked link.
			  cleanInput()
   			 $(req).appendTo('body').modal();
		},
		error: function(req, data){
			console.log(req, data)
			alert('erro' + data)
		}
	})

}
	function cleanInput(){
		nome.val('')
		cpf.val('')
		email.val('')
		telefone.val('')
	}

});

