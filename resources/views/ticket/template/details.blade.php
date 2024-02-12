<div class="row">
    <div class="col-md-12">

        <table class="table table-bordered " >
        <tr>
            <td class="bg-gray" width="15%"> Survey  </td>
            <td class="" >  {{ $ticket->survey }}  </td>
        </tr>
        </table>
        
        <table class="table table-bordered " >
        <tr>
            <td class="bg-gray" width="15%"> Audit Status  </td>
            <td class="" width="35%">  
                <?php if($ticket->status==1) echo '<span class="label label-pill label-primary">New</span>' ?>
                <?php if($ticket->status==2) echo '<span class="label label-pill label-success">In Process</span>' ?>
                <?php if($ticket->status==3) echo '<span class="label label-pill label-danger"> Closed</span>'  ?>
                <?php if($ticket->status==4) echo '<span class="label label-pill label-danger"> Canceled</span>'  ?>
              </td>
            <td class="bg-gray" width="15%">  Auditor Name  </td>
            <td>  {{ $ticket->first_name}} {{ $ticket->last_name }}   </td>
        </tr>
        <tr>
            <td class="bg-gray" >  Audit Start Date  </td>
            <td width="35%">   {{ $ticket->audit_start_date}}  </td>
            <td class="bg-gray"> Audit End Date  </td>
            <td  width="35%">   {{ $ticket->audit_end_date}}  </td>                    
        </tr>
        </table>

        <table class="table table-bordered "  >
            <tr>
                <td class="bg-gray" width="15%" > Incident Owning Group </td>
                <td width="35%"> {{ $ticket->requester}} </td>
                <td class="bg-gray" width="15%" >   Resolver Group </td>
                <td width="35%"> <a href="/tickets/ssd?q={{ $ticket->resolver_group}}&status={{ $ticket->status }}"> {{ $ticket->resolver_group}} </a></td>
            </tr>
            <tr>
                <td class="bg-gray"> Module </td>
                <td> {{ $ticket->service}} </td>
                <td class="bg-gray"> Priority </td>
                <td> {{ $ticket->priority }}  </td>
            </tr>
            <tr>
                <td class="bg-gray" width="15%" > Open date </td>
                <td width="35%"> {{ $ticket->open_date}} </td>
                <td class="bg-gray" width="15%" >   Closed date </td>
                <td width="35%">  {{ $ticket->closed_date}} </td>
            </tr>
            <tr>
                <td class="bg-gray">  Open/Reported by  </td>
                <td> {{ $ticket->reported_by}}  </td>
                <td class="bg-gray"> Closed by </td>
                <td> {{ $ticket->closed_by}}</td>
            </tr>
        </table>

        <table class="table table-bordered "  >
            <tr>
                <td class="bg-gray" width="15%" > Coached </td>
                <td width="35%"> {{ $ticket->coached==1 ? 'YES' : 'NO' }} </td>
                <td class="bg-gray" width="15%" >   Coached by </td>
                <td width="35%"> @if($ticket->coached==1) {{ $ticket->coach->first_name}} {{ $ticket->coach->last_name}} @endif</td>
            </tr>
        </table>

                        
    </div>
</div>   
