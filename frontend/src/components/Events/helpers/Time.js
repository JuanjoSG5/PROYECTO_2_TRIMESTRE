export function getTime(){
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = ('0' + (currentDate.getMonth() + 1)).slice(-2); 
    const day = ('0' + currentDate.getDate()).slice(-2); 
    const hours = ('0' + currentDate.getHours()).slice(-2); 
    const minutes = ('0' + currentDate.getMinutes()).slice(-2); 
    const seconds = ('0' + currentDate.getSeconds()).slice(-2); 
    return`${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

}

export function getFormattedTime(time){
    const date = new Date(time);
    const year = date.getFullYear();
    const month = ('0' + (date.getMonth() + 1)).slice(-2); 
    const day = ('0' + date.getDate()).slice(-2); 
    const hours = ('0' + date.getHours()).slice(-2); 
    const minutes = ('0' + date.getMinutes()).slice(-2); 
    return`${day}/${month}/${year} ${hours}:${minutes}`;
}