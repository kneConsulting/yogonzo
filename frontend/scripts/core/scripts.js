function isEmailValid(email){ 
	var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
	return filter.test(email);
}

// console.log(isEmailValid("kiko127@li.ve.commmm.br.pt.uk"));