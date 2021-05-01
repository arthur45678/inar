let marzer = [
  {
    id:1,
    name:"Aragacotn",
    class_name:"aragacotn",
    img_active:"aragacotn-active.png",
  },
  {
    id:2,
    name:"Ararat",
    class_name:"ararat",
    img_active:"ararat-active.png",
  },
  {
    id:3,
    name:"armavir",
    class_name:"armavir",
    img_active:"armavir-active.png",
  },
  {
    id:4,
    name:"Gegharquniq",
    class_name:"gegharquniq",
    img_active:"gegharquniq-active.png",
  },
  {
    id:5,
    name:"Lori",
    class_name:"lori",
    img_active:"lori-active.png",
  },
  {
    id:6,
    name:"Kotayq",
    class_name:"kotayq",
    img_active:"kotayq-active.png",
  },
  {
    id:7,
    class_name:"shirak",
    img_active:"shirak-active.png",
  },
  {
    id:8,
    name:"Syuniq",
    class_name:"syuniq",
    img_active:"syuniq-active.png",
  },
  {
    id:9,
    name:"Vayoc-dzor",
    class_name:"vayoc-dzor",
    img_active:"vayoc-dzor-active.png",
  },
  {
    id:10,
    name:"Erevan",
    class_name:"erevan",
    img_active:"erevan-active.png",
  },
    {
        id: 11,
        name: "Tavush",
        class_name: "tavush",
        img_active: "tavush-active.png",
    }
];



createButton=(inner,class_name)=>{
    const button = document.createElement("button");
    button.innerHTML = inner;
    button.setAttribute("class","region_name region-"+class_name);
    qartez.appendChild(button);
}

createImg=(obj)=>{
    const image = document.createElement("img");
    Object.assign(image,obj);
    map_part.appendChild(image);
}

for(region in regions){
    createButton(regions[region].name,region);
}

const host=window.location.hostname;
const general = document.querySelectorAll("area");
let source_active = "/asset/Region/png-marzer-active/";
let source =  "/asset/Region/png-marzer/";

info=(index)=>{
    // for(var aa in regions[index]){
    //     if(regions[index][aa] == null){
    //         regions[index][aa] = "";
    //     }
    // }
    region_name.innerHTML = regions[index].name;
    territorya.innerHTML = regions[index].informate.territory
    agricultural.innerHTML = regions[index].informate.agricultrual_land;
    population.innerHTML = regions[index].informate.total_population;
    urban.innerHTML = regions[index].informate.urban;
    rural.innerHTML = regions[index].informate.rural;
    workspace.innerHTML = regions[index].informate.total_workforce;
    employed.innerHTML = regions[index].informate.employed;
    salary.innerHTML = regions[index].informate.average_salary;
    success.innerHTML = regions[index].informate.success_case;
    specialization.innerHTML = regions[index].informate.specialization;
    weather.innerHTML = regions[index].main_part.weather;
    region_centre.innerHTML = regions[index].main_part.region_center_title;
    // distinations.innerHTML = regions[index].main_part.average_prices;
    georgia.innerHTML = regions[index].main_part.Georgia
    erevan.innerHTML = regions[index].main_part.Yerevan;
    iran.innerHTML = regions[index].main_part.Iran;
    region_centre_info.innerHTML = regions[index].main_part.region_center_info;
    region_center_other.innerHTML = regions[index].main_part.region_center_other;
    average_prices.innerHTML = regions[index].main_part.average_prices;
    average_other.innerHTML = regions[index].main_part.average_other;
    val_agr.style.width = regions[index].informate.agricultrual_land+"%"
    if(regions[index].informate.agriculture == null){
        agriculture.innerHTML = "";
    }else{
        agriculture.innerHTML = regions[index].informate.agriculture+"%"
    }
    /*agriculture.innerHTML = regions[index].informate.agricultrual_land*/
    agriculture_comment.innerHTML = regions[index].informate.agriculture_comments
    val_retail.style.width = regions[index].informate.retail_trade+"%"
    retail.innerHTML = regions[index].informate.retail_trade
    retail_comment.innerHTML = regions[index].informate.retail_trade_comments
    val_construction.style.width = regions[index].informate.construction+"%"
    construction.innerHTML = regions[index].informate.construction
    construction_comment.innerHTML = regions[index].informate.construction_comments
    //val_industry.style.width = regions[index].informate.industry+"%"
    industry.innerHTML = regions[index].informate.industry
    industry_comment.innerHTML = regions[index].informate.industry_comments
    tourism.innerHTML = regions[index].informate.tourism
    cropproduction.innerHTML = regions[index].informate.cropproduction
    portable_energy.innerHTML = regions[index].informate.portable_energy
    food_processing.innerHTML = regions[index].informate.food_processing
    beverage_production.innerHTML = regions[index].informate.beverage_production
    textile.innerHTML = regions[index].informate.textile
    field_1.innerHTML = regions[index].informate.field_1
    field_2.innerHTML = regions[index].informate.field_2
    field_3.innerHTML = regions[index].informate.field_3
    field_4.innerHTML = regions[index].informate.field_4

}

const marz = document.querySelectorAll(".region_name");

marz.forEach((item,index)=>{
    item.addEventListener("mouseover",()=>{
        for(c=0;c<marz.length;c++){
            marz[c].removeAttribute("disabled");
            marz[c].style.color = "inherit";
        }
        item.setAttribute("disabled",true);
        item.style.color = "#fff";
        let val = marzer[index];
        map_part.innerHTML="";
        createImg({
            src:source_active+val.img_active,
            className:val.class_name+" translate",
        });

        info(index);
   });
});



