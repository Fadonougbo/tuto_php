type Data={
    created_at:string,
    id:number,
    message:string,
    message_id:number,
    name:string,
    password:string,
    updated_at?:string
    user_id:number
}

export class Chat
{
    private messageContainer:HTMLDivElement;
    private form:HTMLFormElement;
    private textInput:HTMLTextAreaElement;

     constructor()
    {
        this.messageContainer=document.querySelector("#message_list") as HTMLDivElement

        this.form=document.querySelector("#message_form") as HTMLFormElement
        this.textInput=document.querySelector("textarea") as HTMLTextAreaElement

        this.showMessageList=this.showMessageList.bind(this);
        this.setMessage=this.setMessage.bind(this)
        this.getMessageList=this.getMessageList.bind(this)
        /* this.keyAction=this.keyAction.bind(this) */

        this.getMessageList();  
        /* this.keyAction() */
        this.action()

    }

    public autoReload(interval:number)
    {
        setTimeout(()=>{
 /*            console.log("ok"); */
           requestAnimationFrame(this.getMessageList)
            this.autoReload(interval)
        },interval)

    }

    /**
     * Affiche la liste de tous les messages
     */
    private async getMessageList()
    {
      const data=await fetch("/messages",{
            method:"POST"
        })
      const res=await data.json() as Data[]

        if(data) {
            this.showMessageList(res)
        }
        
    }

    /**
     * Ajoute un message dans la base de donnees apres soumission du formulaire
     */
    private async action()
    {

        const formSubmit=async (e:SubmitEvent)=>{

            e.preventDefault()
        
            const form=e.currentTarget as HTMLFormElement
        
            const formData=new FormData(form)
        
            const data=Object.fromEntries(formData) as {message:string} ;

            if(data.message.trim()==="" && data.message.length<11)
            {
                alert(`status:le champs message ne doit pas etre vide ❌❌❌`)
            }else 
            {
                const response=await this.setMessage(formData)
                !response.status?alert("Nous avons rencontré un problème ❌❌❌"):'';
            } 
            
        }
        
        this.form?.addEventListener("submit",formSubmit)
    }

   /*  private  keyAction() {

        const onKeyup=(e:KeyboardEvent)=> {
            e.preventDefault();

            if(e.key==="Enter") {
                this.form.focus()
            }
        }

        this.textInput?.addEventListener("keyup",onKeyup)

    }
 */
    /**
     * 
     * @param message 
     * @returns Promise<any>
     */
    private setMessage(message:FormData)
    {
        const data=fetch("/new/message",{
            method:"POST",
            body:message
        })
        .then((res)=>res.json())
        .then((data)=>data)

        return data
    }

    /**
     * affiche les messages sur la page
     * @param data 
     */
    private async  showMessageList(data:Array<Data>)
    {
        const userInfo=await fetch("/user")
        .then((res)=>res.json())
        .then((data)=>data)

        this.messageContainer.innerHTML=""

        if(!userInfo.id) {

            this.messageContainer.innerHTML="<h1>Aucun message</h1>"
            return false;
        }

        if(Array.isArray(data)&&data.length===0)
        {
            this.messageContainer.innerHTML="<h1>Aucun message</h1>"
            return false;
        }

        data.forEach((el)=>
        {
            const {name,message,created_at,user_id}=el

            if(this.messageContainer)
            {
                this.messageContainer.innerHTML+=`
                    <section class="${userInfo.id===user_id?'active':''}">
                    <h2>
                            <strong>${name}</strong>
                            <span>${created_at}</span>
                        </h2> 
                        <p>${message}</p>
                        </section>
                    `
            }
        })
        
    }

}