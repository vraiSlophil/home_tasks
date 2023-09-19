const loginSection = document.querySelector("section.login");
const registerSection = document.querySelector("section.register");
const toRegisterButton = document.querySelector("section.login > form > .buttons > .register");
const toLoginButton = document.querySelector("section.register > form > .buttons > .login");

function toggleHideSection() {

    loginSection.classList.contains("hide") ? loginSection.classList.remove("hide") : loginSection.classList.add("hide");
    registerSection.classList.contains("hide") ? registerSection.classList.remove("hide") : registerSection.classList.add("hide");
}
toRegisterButton.addEventListener("click", () => {
    toggleHideSection();
});
toLoginButton.addEventListener("click", () => {
    toggleHideSection();
});
