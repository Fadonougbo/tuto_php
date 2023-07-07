"use strict";
const form = document.querySelector("form");
const getMessages = () => {
};
const formSubmit = (e) => {
    e.preventDefault();
    const form = e.currentTarget;
    const formData = new FormData(form);
    const data = Object.fromEntries(formData);
    console.log(data);
};
form?.addEventListener("submit", formSubmit);
