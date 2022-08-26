let delcheckboxes = document.querySelectorAll(".delete-checkbox");
let savebtn = document.querySelector(".buttons .nav__button");
let productType = document.querySelector("#productType");
let delbtn = document.querySelector("#delete-product-btn");
delcheckboxes.forEach(item => {
	item.onclick = () => {
		if (item.parentElement.classList.contains("active"))
			item.parentElement.classList.remove("active");
		else{
			item.parentElement.classList.add("active");
		}
	};
});
if (productType){
	$(productType).change(() => {
		if (productType.selectedIndex != 0){
			let i = 0;
			let found = "";
			productType.querySelectorAll("option").forEach(option => {
				if (i == productType.selectedIndex){
					found = option;
					i++;
				}else{
					i++;
				}
			});
			if (found != ""){
				let productID = found.textContent;
				document.querySelectorAll(".form__other").forEach(fm => {
					fm.querySelectorAll("input").forEach(inp => {
						inp.value = "";
						inp.removeAttribute("required");
					});
					if (fm.id == productID){
						fm.classList.remove("disabl");
						fm.querySelectorAll("input").forEach(inp => {
							inp.value = "";
							inp.removeAttribute("disabled");
							inp.setAttribute("required", true);
						});
					}else{
						if (fm.classList.contains("disabl")){
							// PASS
						}else{
							fm.classList.add("disabl");
							fm.querySelectorAll("input").forEach(inp => {
								inp.setAttribute("disabled", true);
								inp.removeAttribute("required");
								inp.value = "";
							});
						}
					}
				});
			}else{
				console.log("Not found!");
			}
		}
	});
}
if (document.querySelector("#product_form")){
	if (savebtn.textContent == "Save"){
		savebtn.onclick = () => {
			let form = document.querySelector("#product_form");
			let product_form_inputs = document.querySelectorAll('#product_form input');
			product_form_inputs.forEach(item => {
				// ERROR
				const errorElement = document.createElement('span');
				errorElement.id = `input-error`;
				item.setAttribute('aria-describedby', errorElement.id);
				item.insertAdjacentElement("afterend", errorElement);
				// ERROR
				const isValid = item.checkValidity();
				item.setAttribute("aria-invalid", !isValid);
				if (!isValid) {
				    const errorMessage = item.validationMessage;
				    errorElement.textContent = errorMessage;
				}
				item.addEventListener('input', (e) => {
				  if (errorElement.textContent) {
				    e.target.removeAttribute('aria-invalid');
				    errorElement.textContent = '';
				  }
				});
			});
			if (form.checkValidity()){
				form.submit();
			}
		};
	}
}
function post(path, params, method='post') {
  const form = document.createElement('form');
  form.method = method;
  form.action = path;
  for (const key in params) {
    if (params.hasOwnProperty(key)) {
      const hiddenField = document.createElement('input');
      hiddenField.type = 'hidden';
      hiddenField.name = key;
      hiddenField.value = params[key];
      form.appendChild(hiddenField);
    }
  }
  document.body.appendChild(form);
  form.submit();
}
delbtn.onclick = () => {
	dellist = "";
	document.querySelector(".wrapper .products").querySelectorAll(".product").forEach(product => {
		if (product.classList.contains("active"))
			dellist += product.id + ",";
	});
	dellist = dellist.slice(0, -1);
	post('./?del', {list: dellist});
};