
const day = document.querySelectorAll(".amsativ");
const orer = document.querySelectorAll(".day>p");
const monts = document.querySelectorAll(".months-container>p")
const days_week = document.querySelectorAll(".days-header>p");

let num = 0;
for(x=0;x<monts.length;x++){
    num++;
    (num <10) ? tiv = "0"+num : tiv = num;
    monts[x].setAttribute("name",tiv);
    monts[x].innerHTML = mnts2[x];
}

let arr = [];

for(w of week){
    let sl = w.slice(0,3);
    arr.push(sl);
}

for(y=0;y<days_week.length;y++){
    days_week[y].innerHTML =arr[y];
}

function SelectDay(a,f){
    let b = a.split(" ");
    let split = b[0].split("-");
    return split[f];
}

function addProp(a,b){
    document.getElementById(a).classList.add("active");
    document.getElementById(a).setAttribute("name",b);
    document.getElementById(a).setAttribute("onclick","ff(this)");
}

let data = new Date();

$(window).on("load",function (){
    events($("p.selected-month"));
    next_events.innerHTML = Lossiguienteseventos;
});

function not_nul(anun,num){
    let z = SelectDay(today,num);
    if(z<10){
        var g = z.slice(-1)-1;
        document.getElementById(anun).innerHTML = mnts[g];
    }else{
        document.getElementById(anun).innerHTML = mnts[z-1];
    }
}

function non(anun,num){
    let z = SelectDay(today,num);
    if(z<10){
        var g = z.slice(-1);
        document.getElementById(anun).innerHTML = g;
    }else{
        document.getElementById(anun).innerHTML = z;
    }
}





monts.forEach(item=>{
    item.onclick=()=>{
        events(item)
        or.innerHTML = "";
        sh_or.innerHTML = "";
    }
});

orer.forEach(item=>{
    item.onclick=()=>{
        this_day(item);
    }
});



function this_day(that){
    document.getElementById("or").innerHTML = that.innerHTML;
    document.getElementById("sh_or").innerHTML = "";
    // alert("test");
}

function events(tag){
    for(e of post_json){
        var ii = e.id
        if($(tag).attr("name") == SelectDay(e.event_started_date,1)){
            for(a of day){
                    if(a.id == SelectDay(e.event_started_date,2) &&
                     year.innerHTML == SelectDay(e.event_started_date,0)) {
                        addProp(a.id, ii)
                    }
                }
            }
        }
    }

function createElem(txt){
    const div = document.createElement("div");
    div.innerHTML = '<i class="far fa-check-circle"></i><span>'+txt+'</span>'
    next.appendChild(div);
}

for(ev of eventsa){
    createElem(ev.name.en);
}
console.log(eventsa);
console.clear();
