{*
	variables that are available:
	- {items}: contains an array with all the artists
*}
<div class="artists line-up-overview row">
  <div class="col-md-12">
     <div class="">
        <div class="row stage">
            <div class="col-md-12">
               <h2>{$lblFriday|ucfirst}</h2>
            </div>
            <div class="grid stage-title">
                {iteration:friday}
                <div class="col-sm-4 grid-item">
                  <div class="stage-friday">
                     <h3>{$friday.stage}</h3>
                     <div class="clear"></div>
                     {iteration:friday.artist}
                         <p class="hour">{$friday.artist.date}</p><p class="artist-name"><a href="{$friday.artist.url}">{$friday.artist.name}</a></p>
                     {/iteration:friday.artist}
                     <div class="clear"></div>
                  </div>
                </div>
                {/iteration:friday}
            </div>
         </div>

         <div class="row stage">
            <div class="col-md-12">
                 <h2>{$lblSaturday|ucfirst}</h2>
             </div>
             <div class="grid stage-title">
                {iteration:saturday}
                 <div class="col-sm-4 grid-item">
                     <div class="stage-saturday">
                         <h3>{$saturday.stage}</h3>
                         <div class="clear"></div>
                         {iteration:saturday.artist}
                             <p class="hour">{$saturday.artist.date}</p><p class="artist-name"><a href="{$saturday.artist.url}">{$saturday.artist.name}</a></p>
                         {/iteration:saturday.artist}
                         <div class="clear"></div>
                     </div>
                 </div>
                {/iteration:saturday}
            </div>
        </div>
        <div class="row stage">
            <div class="col-md-12">
                <h2>{$lblSunday|ucfirst}</h2>
            </div>
            <div class="grid stage-title">
                {iteration:sunday}
                     <div class="col-sm-4 grid-item">
                         <div class="stage-sunday">
                             <h3>{$sunday.stage}</h3>
                             <div class="clear"></div>
                             {iteration:sunday.artist}
                                 <p class="hour">{$sunday.artist.date}</p><p class="artist-name"><a href="{$sunday.artist.url}">{$sunday.artist.name}</a></p>
                             {/iteration:sunday.artist}
                             <div class="clear"></div>
                         </div>
                     </div>
                 {/iteration:sunday}
             </div>
        </div>
        <div class="clear"></div>
     </div>
  </div>
</div>
