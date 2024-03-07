const filterForm = document.querySelector(".filter-form");
const allInput = document.querySelector("#all")


filterForm.onclick = function (e) {
  if (!e.target.id.includes("all")) {
    if(e.target.checked == true) {
      allInput.checked = false
    }
  }
};

function unsetCheckbox(soLuongDanhMuc) {
  let count = 1;
  for(let i = 1; i <= soLuongDanhMuc; ) {
    let checkedInput = document.querySelector(`#danhmuc${count}`)

    if(checkedInput) {
      checkedInput.checked = false;
      i++;
    }
    count++;
  }
}
