    var purchaseNumberId;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $(".PurchaseNumberSubmit").attr("enabled", true);
        $(".PurchaseNumberSubmit").click(function(e){
            $(".PurchaseNumberSubmit").attr("disabled", true);
            e.preventDefault();
            $.ajax({
               url:'/purchaseordernumber/create',
               data:{},
               success:function(data){
                   purchaseNumberId = data.purchaseNumber[1];
                  $(".generatedPurchaseNumber").text(data.purchaseNumber[0]);
                  $(".PurchaseNumberSubmit").hide();
                  $(".PurchaseNumberDestroy").show();
               }
            });
        });

        $(".PurchaseNumberDestroy").click(function(e){
            e.preventDefault();
            $.ajax({
                type: 'DELETE',
               url:'/purchaseordernumber/'+ purchaseNumberId,
               data:{},
               success:function(data){
                $(".PurchaseNumberSubmit").show();
                $(".generatedPurchaseNumber").text('PPL/___/__/__/PO');
               }
            });
        });
