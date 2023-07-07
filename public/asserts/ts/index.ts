

const form=document.querySelector("form") as HTMLFormElement

const getMessages=()=>{

}

const formSubmit=(e:SubmitEvent)=>{

    e.preventDefault()

    const form=e.currentTarget as HTMLFormElement

    const formData=new FormData(form)

    const data=Object.fromEntries(formData) ;

    console.log(data);

}

form?.addEventListener("submit",formSubmit)