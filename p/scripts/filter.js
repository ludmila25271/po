// Объект фильтрации
let filter = {
	// Хранилище данных
	storage: [],
	// Сторона сортировки
	sort: false,
	// Запись товаров в хранилище
	products: function() {
		filter.storage = [];
		document.querySelectorAll("#products_list .shop_box").forEach(elem => {
			filter.storage.push({
				"name" : 	elem.querySelector("h3").innerHTML,
				"promo": 	elem.querySelector("img").src,
				"price": 	elem.querySelector("p").innerHTML,
				"product_id": elem.querySelector("input[name=id]").value,
				"year" : 	elem.querySelector("input[name=year]").value,
				"category": elem.querySelector("input[name=category]").value,
			});
		});
	},
	// Запись заказов в хранилище
	orders: function() {
		filter.storage = [];
		document.querySelectorAll("#orders .col").forEach(elem => {
			let b = elem.querySelectorAll("b");
			filter.storage.push({
				"name"   : 	elem.querySelector("h2").innerHTML,
				"fio"    : 	b[0].innerHTML,
				"status" : 	b[1].innerHTML,
				"count"  : 	b[2].innerHTML,
				"reason" : 	(reason = elem.querySelector("p.reason")) ? reason.innerHTML : null,
				"order_id": elem.querySelector("input[name=order_id]").value,
				"timestamp": elem.querySelector(".time").innerHTML,
			});
		});
	},
	// Фильтрация данных по переданным параметрам
	filter: function(param, type) {
		let array = JSON.parse(JSON.stringify(filter.storage));
		if(type == "admin") {
			if(param != "all")
				array = array.filter(order => order.status == param);
			return filter.out(array, "orders");
		}
		filter.sort = !filter.sort;
		switch(type) {
			case "sort":
				if(filter.sort) array.sort((a, b) => (a[param] > b[param]) ? 1 : -1);
				else array.sort((a, b) => (a[param] < b[param]) ? 1 : -1);
			break;
			case "filter":
				category = document.getElementById("category").value;
				array = array.filter(product => product.category == category);
			break;
		}

		if(param == "all")
			array = JSON.parse(JSON.stringify(filter.storage));

		return filter.out(array, "products_list");
	},
	// Вывод отфильтрованных данных
	out: function(array, type) {
		let data = "";

		// Запись товаров
		if(type == "products_list") {
			array.forEach(product => {
				data += `
				<div class="shop_box" id="products"> <!--Товар-->
        <h3 class="prod_name">${product.name}</h3>
        <img src="${product.promo}" height="190px" width="300px" alt="Mercedes-Benz S-класс" title="Mercedes-Benz S-класс">
        <div class="info">
         <p class="price">${product.price}</p>
         <a class="more" href="product.php?c=products&id=${product.product_id}">Подробнее</a>
         <input type="hidden" value='${product.product_id}' name="id">
         <input type="hidden" value='${product.year}' name="year">
         <input type="hidden" value='${product.category}' name="category">
		`;
		data += (role != "guest") ? `<a class="add_c" href="controllers/add_cart.php?id=${product.product_id}"><img src="img/add_cart.png" height="25px" alt="Добавить в корзину" title="Добавить в корзину"></a>` : '';
		data += `</div>`;	
		data += (role == "admin") ? `
		<div class="r">
		<p><a class="grey" id="grey1" href="update.php?id=${product.product_id}">Редактировать</a></p>
		<p><a class="grey" onclick="return confirm(\'Вы действительно хотите удалить этот товар?\')" href="controllers/delete_product.php?id=${product.id}">Удалить</a></p>
	</div>` : '';
		data += `</div>`;		
			});
		// Запись заказов
		} else if(type == "orders") {
			array.forEach(order => {
				if(order.status == "Подтверждённый") end = "";
				else end = (order.status == "Новый") ? `
					<form action="controllers/confirm_order.php" class="w100" method="POST">
						<input type="hidden" value="${ order.order_id }" name="id" />
						<button class="btn">Подтвердить заказ</button>
					</form>
					<h3 class="text-center">Отменить заказ</h3>
					<form action="controllers/cancel_order.php" class="w100" method="POST">
						<input type="hidden" value="${ order.order_id }'" name="id" />
						<div class="row_align">
						<textarea class="text_area" placeholder="Причина отмены" name="reason" required></textarea>
						<button class="btn">Отменить заказ</button>
						</div>
					</form>
				` : `
					<h3 class="text-center">Причина отмены:</h3>
					<p class="reason">${ order.reason }</p>
				`;
				data += `
					<div class="col">
						<h2>${ order.name }</h2>
						<p style="margin-top:5px; font-size:23px;">Заказчик: <b>${ order.fio }</b></p>
						<p>Статус заказа: <b>${ order.status }</b></p>
						<p>Количество товаров: <b>${ order.count }</b></p>
						${ end }
						<p class="time">${ order.timestamp }</p>
					</div>
				`;
			});
		} else return;
		if(!data)
			data = "<h3>Данные отсутствуют</h3>";

		// Вывод записанных данных
		document.getElementById(type).innerHTML = data;
	}
}