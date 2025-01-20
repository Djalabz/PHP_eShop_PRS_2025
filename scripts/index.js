let profileBtn = document.querySelector(".profile-button")
let profileMenu = document.querySelector("#profileMenu")

console.log(profileMenu);

profileBtn.addEventListener("click", () => {

    profileMenu.classList.toggle("hidden")
 
    // Equivalent de la ligne du dessus
    // if (profileMenu.classList.contains("hidden")) {
    //     profileMenu.classList.remove("hidden")
    // } else {
    //     profileMenu.classList.add("hidden")
    // }
})

