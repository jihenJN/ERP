<script>
    $(document).ready(function() {

        $('.findtth').on('change', function() {
            //alert();
            index = $(this).attr('index'); //alert(index)
            //alert(index);
            tva = $('#tva' + index).val() || 0;
            fodec = $('#fodec' + index).val() || 0;
            qte = $('#qte' + index).val() || 0;
            ml = $('#ml' + index).val()|| 0;

            remise = $('#remise' + index).val() || 0;
            ttc = $('#ttc' + index).val();
            TTH = (Number(ttc) / (1 + Number(tva / 100))).toFixed(3);
            TTHf = (Number(TTH) / (1 + Number(fodec / 100))).toFixed(3); //alert(TTHf)
            $('#motanttotal' + index).val(TTHf);
            if (Number(qte) == 0) {
                tot = (Number(TTHf) / (1 - Number(remise / 100))).toFixed(3);
                prix = (Number(tot)).toFixed(3);
                prixu = Number(prix) * (1 - Number(remise / 100));
                puttc = prixu * (1 + Number(tva / 100));
            } else {
                tot = (Number(TTHf) / (1 - Number(remise / 100))).toFixed(3);
                prix = ((Number(tot)) / Number(qte)); //alert(prix)
                //      remisee=(Number(prix)*Number(remise))/100;alert(remisee)
                prixu = Number(prix) * (1 - Number(remise / 100));
                alert(prixu);
                puttc = Number(prixu) * (1 + Number(tva / 100));
              //  alert(prixu);
            }
            //$('#prixhtva'+index).val(prix);
            // $('#totalhtans'+index).val(prix);
            $('#prix' + index).val(prixu);
            $('#ht' + index).val(tot);
            //$('#puttc'+index).val(puttc.toFixed(3));
            ind = Number($('#index').val()); //alert(ind+'ind')
            i = ind;
            //   $('#remisearticle'+index).val(0);
            //            if(ind!=index){
            //                indexpre = Number(index)+1;
            //          // alert(indexpre+"indexpre");
            //                if( $('#articlee' + indexpre).val()!=""){
            //                    $('#sup' + indexpre).val('1');
            //         $(this).parent().parent().hide();
            //        }}
            // alert(index);
            articleid = $('#article_id' + index).val(); //alert(articleid)
            qte = $('#qte' + index).val();
            tim = $('#timbre').val();
            total = 0;
            totalremise = 0;
            remisecommande = 0;
            montanttpe = 0;
            montantfodec = 0;
            montanttva = 0;
            totalttc = 0;
            totalCommandettc = 0;
            motanttotal = 0;
            ttc = 0;
            fodeccommandeclient = 0;
            fodbc = 0;
            tpecommandeclient = 0;
            tpecmd = 0;
            monatantlignetva = 0;
            tvacomdbc = 0;
            //mahdi-------------------------------
            baseHT = 0;
            brutHT = 0;
            totrem = 0;
            totbrut = 0;
            totrmt = 0;
            montantescompte = 0;
            // tvacomd=0;
            vacomd = 0;
            totalmontantescompteligne = 0;
            totalmontantescomptelignee = 0;
            totalmotanttotal = 0;
            totaltpecommandeclient = 0;
            tpecommandeclient = 0;
            motanttotaltpebc = 0;
            totalpoidsfin = 0;
            totalpoids = 0;
            nb = 0;
            for (j = 0; j <= ind; j++) {
                // alert(j);
                sup = $('#sup' + j).val(); // alert(sup);
                if (Number(sup) != 1) {
                    nb++;
                    tpe = $('#tpe' + j).val() || 0;
                    tva = Number($('#tva' + j).val()) || 0; // alert(tva);
                    fodec = $('#fodec' + j).val() || 0; //alert(tpe);
                    fodecclientexo = $('#fodecclientexo').val();
                    tpeclientexo = $('#tpeclientexo').val();
                    tvaclientexo = $('#tvaclientexo').val();
                    qte = ($('#qte' + j).val()) * 1; //alert(qte+"qte");
                    if (qte == '') {
                        qte = 1;
                    }
                    poids = ($('#poids' + j).val()) * 1; //alert(poids+"poids");
                    totalpoids = Number(qte) * Number(poids);
                    totalpoidsfin += Number(totalpoids);
                    prix = $('#prix' + j).val(); // alert(prix);
                    qteStock = ($('#qteStock' + j).val()) * 1; //alert(qteStock);
                    remisearticle = $('#remise' + j).val(); //alert(remisearticle);
                    netbrut = (Number(qte) * Number(prix)); //alert(netbrut);
                    //   alert(netbrut);
                    totalremise = Number(remisearticle);
                    montremise = netbrut * totalremise / 100;
                    montcal = netbrut - montremise; //alert(montcal);
                    totbrut += Number(prix) * Number(qte); //alert(totbrut+'totbrut')
                    //getremsie(totbrut) ;
                    remiseclient = $('#remiseclient' + j).val() || 0; //alert(remiseclient+"remiseclient")
                    //                        montremiseclient = montcal* remiseclient / 100;//alert(montremiseclient)
                    //                        totremiseclient=Number(montremiseclient)+Number(montremise);//alert(totremiseclient)
                    //                                //    alert(totremiseclient);
                    //                         $('#totremiseclient' + j).val(Number(totremiseclient)); // alert(motanttotal);
                    //                        motanttotal=montcal-montremiseclient;//alert(motanttotal+'motanttotalremise');
                    //
                    montremiseclient = Number(netbrut) * (Number(remiseclient) + Number(remisearticle)) / 100; //alert(montremiseclient)
                    totremiseclient = Number(montremiseclient); //alert(totremiseclient)
                    //    alert(totremiseclient);
                    $('#totremiseclient' + j).val(Number(totremiseclient)); // alert(motanttotal);
                    motanttotalbc = Number(netbrut) - Number(montremiseclient); //alert(motanttotal+'motanttotalremise');
                    $('#motanttotal' + j).val(Number(motanttotalbc)); // alert(motanttotal);
                    totrem = Number(totrem) + Number(totremiseclient); //alert(totrem+'totrem');
                    totaltotal = Number($('#motanttotal' + j).val()); //alert(Number($('#motanttotal' + j).val())+'total')
                    total = Number(total) + Number(motanttotalbc); //alert(Number($('#motanttotal' + j).val())+'total')
                    totremiseclientt = ($('#totremiseclient' + j).val());
                    totrmt += Number(totremiseclientt);
                    remisecommande += Number($('#remiseligne' + j).val()); //alert(remisecommande+'remisecommande')
                    //pourcentageescompte
                    {
                        $('#valeurescompte').val(0); //alert(valeurescompte+"valeurescompte");
                        valeurescompte = $('#valeurescompte').val();
                        montantescompte = 0; //alert(montantescompte);$('#escompte').val(0);}
                        // alert(montantescompte+"esc");
                        //  $('#escompte').val(Number(montantescompte).toFixed(3));
                        montantescompteligne = Number(motanttotalbc) * Number(valeurescompte) / 100;
                        totalmontantescompteligne += Number(montantescompteligne);
                        montantescompteligneebc = Number(motanttotalbc) - Number(montantescompteligne);
                        totalmontantescomptelignee += Number(montantescompteligneebc);
                        montantescompte += Number(montantescompteligne);
                        $('#escompte' + j).val(Number(montantescompteligneebc).toFixed(3));
                    }
                    //  alert(valeurescompte+"valeurescompte");
                    prixavecformulclient(prix, j, formule, fodec, tva, tpe, valeurescompte, remiseclient, remisearticle);
                    {
                        montanttpe = 0 //alert(montanttpe);
                        motanttotaltpebc += montanttpe;
                        $('#tpecommandeclient' + j).val(Number(montanttpe));
                        //                            tpecommandeclient = Number(motanttotal) + Number(montanttpe); //alert(tpecommandeclient);
                        //                            totaltpecommandeclient += Number(tpecommandeclient);
                    }
                    if (fodec != 0 && fodecclientexo == '') {
                        //   alert("cc");
                        montantfodec = Number(montantescompteligneebc) * Number(fodec) / 100;
                        fodbc += montantfodec;
                        motanttotall = Number(montantescompteligneebc) + Number(montantfodec); //alert(motanttotal);
                        totalmotanttotal += Number(motanttotall);
                        $('#fodeccommandeclient' + j).val(Number(montantfodec));
                    } else {
                        montantfodec = 0;
                        fodbc += Number(montantfodec);
                        $('#fodeccommandeclient' + j).val(Number(montantfodec));
                        motanttotall = Number(montantescompteligneebc) + Number(montantfodec); //alert(motanttotal);
                        totalmotanttotal += Number(motanttotall);
                    } {
                        tpecommandeclient = Number(motanttotall) + Number(montanttpe); //alert(tpecommandeclient);
                        totaltpecommandeclient += Number(tpecommandeclient);
                    }
                    if (tva != 0 && tvaclientexo == '') {
                        //   alert("hh");
                        // alert("tva recup?r? apr?s if");
                        // alert(netht);
                        montanttva = Number(tpecommandeclient) * tva / 100; //alert(montanttva);
                        tvacomdbc += Number(montanttva); //alert(montanttva+"alert(montanttva)")
                        $('#monatantlignetva' + j).val(Number(montanttva));
                        totalttc = Number(tpecommandeclient) + Number(montanttva); //alert(totalttc)
                        // alert(j);
                        // $('#totalttc' + j).val(Number(totalttc));
                        totalCommandettc += Number(totalttc);
                    } else {
                        montanttva = 0;
                        tvacomdbc += Number(montanttva); //alert(montanttva+"alert(montanttva)")
                        $('#monatantlignetva' + j).val(Number(montanttva));
                        totalttc = Number(tpecommandeclient) + Number(montanttva); //alert(totalttc)
                        totalCommandettc += Number(totalttc);
                        // $('#totalttc' + j).val(Number(totalttc));
                    }
                }
            }
            //alert(total);
            // else
            {
                $('#valeurescompte').val(0); //alert(valeurescompte+"valeurescompte");
                valeurescompte = $('#valeurescompte').val();
                montantescompte = 0; //alert(montantescompte);$('#escompte').val(0);}
                //   alert(montantescompte+"esc");
                $('#escompte').val(Number(montantescompte).toFixed(3));
            }
            //                maxpourcentage = response.tab[numbers.length - 1]['pourcentage'];
            //                maxqte = response.tab[numbers.length - 1]['qtemax'];
            //                    brutHT=totalescom+remisecommande;
            //
            //                    baseHT=totalescom+fod+tpecmd;
            // ttcfinal=baseHT+tvacomd;
            mntesc = $('#escompte').val();
            $('#nbligne').val(Number(nb));
            $('#brutHT').val(Number(totbrut).toFixed(3));
            $('#totalremise').val(Number(totrmt).toFixed(3));
            // alert(mntesc+" alert(mntesc);");
            totaltt = Number(totbrut) - Number(totrmt) - Number(mntesc);
            $('#total').val(Number(totaltt).toFixed(3));
            ttf = Number(totaltt) * 1 / 100;
            $('#totalfodec').val(Number(fodbc).toFixed(3));
            //afef  $('#fod').val(Number(ttf).toFixed(3));
            $('#tpecommande').val(Number(motanttotaltpebc).toFixed(3));
            totaltpecommandeclientt = Number(totaltt) + Number(fodbc) + Number(motanttotaltpebc);
            //afef   totaltpecommandeclientt = Number(totaltt) + Number(fod);
            $('#baseHT').val(Number(totaltpecommandeclientt).toFixed(3));
            ttv = Number(totaltpecommandeclientt) * 19 / 100;
            $('#totaltva').val(Number(tvacomdbc).toFixed(3));
            //afef $('#tvacommande').val(Number(ttv).toFixed(3));
            totaltpecommandeclienttc = Number(totaltpecommandeclientt) + Number(tvacomdbc);
            //  afef totaltpecommandeclienttc = Number(totaltpecommandeclientt) + Number(ttv);
            //  $('#totalttccommande').val(Number(totaltpecommandeclienttc).toFixed(3));
            //$('#netapayer').val(Number(totaltpecommandeclienttc).toFixed(3));
            // var timValue = Number(tim);
            // Formater le nombre avec trois dÃ©cimales
            //var timFormatted = timValue.toFixed(3);
            // Mise Ã  jour des valeurs des champs
            $('#ttc').val((Number(totaltpecommandeclienttc)).toFixed(3));
            $('#netapayer').val((Number(totaltpecommandeclienttc)).toFixed(3));
            //totalpoidsfin
            // $('#escompte').val(Number(totalmontantescompteligne).toFixed(3));
            nbpallete = Number(totalpoidsfin) / 450;
            $('#Poids').val(Number(totalpoidsfin).toFixed(3));
            $('#Coeff').val(Number(nbpallete).toFixed(3));
            pal = Number(450);
        });
    });
</script>