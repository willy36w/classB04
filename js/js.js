// JavaScript Document
function lof(x)
{
	location.href=x
}

function del(table,id){
	$.post("./api/del.php",{table,id},function(){
		location.reload()
	}	)
}


function editType(id, dom) {
	let name = $(dom).parent().prev().text();
	let result = prompt("請輸入要修改的分類名稱", name);
	if (result != null) {
		$.post('api/edit_type.php', {
			id,
			name: result
		}, () => {
			//location.reload();
			$(dom).parent().prev().text(result);
		})
	}

}

/**
 * 
 * @param {string} type  big or mid
 * @param {int} id  type id
 * @param {array} selected  選單中是否有已被選擇的值
 */
function getTypes(type = 'big', id = 0,selected=new Array()) {
	$.get("./api/get_types.php", {
		type,
		id,
	}, (types) => {
		//console.log(type,selected)
		switch (type) {
			case 'big':
				$("#bigSelect").html(types)

				//如果有選擇的值，則將選擇的值設定為選單的值
				if(selected.length>0){
					$("#bigSelect").val(selected[0])

					//如果大分類有選擇的值，則取得中分類被選擇的值
					getTypes('mid',selected[0],[selected[1]])
				}
				break;
			case 'mid':
				$("#midSelect").html(types)

				//如果有選擇的值，則將選擇的值設定為選單的值
				if(selected.length>0){
					$("#midSelect").val(selected[0])
				}
				break;
		}
	})
}

function addType(type) {
	let big, mid;
	switch (type) {
		case 'big':
			big = $("#big").val();
			$.post('api/add_type.php', {
				type,
				big
			}, () => {
				location.reload();
				//getTypes('big', 0);
				//$("#big").val('');
			})
			break;
		case 'mid':
			big = $("#bigSelect").val();
			mid = $("#mid").val();
			$.post('api/add_type.php', {
				type,
				big,
				mid
			}, () => {
				location.reload();
			})
			break;
	}
}