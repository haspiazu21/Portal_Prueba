<?php
echo                '<form name="PAGOS" action="fin_pedido.php" method="POST" enctype="multipart/form-data">
                        <div class="col-1">
                            <table border="0" width="300" cellspacing="1" cellpadding="1">

                                <thead>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Numero de Tarjeta</th>
                                        <th><input type="number" name="txt_tarjeta" value="" size="50" /></th>
                                    </tr>
                                    <tr>
                                        <td>Tipo Tarjeta</td>
                                        <td><select autofocus="true" name="ls_tipo_tarjeta">
                                                <option selected="selected" value="0">Seleccione...</option>
												<option value="1">Debito</option>
                                                <option value="2">Credito</option>
                                            </select></td>
                                    </tr>
                                    <tr>
                                        <td>Banco</td>
                                        <td><select autofocus="true" name="ls_banco">
                                                <option selected="selected" value="0">Seleccione...</option>
												<option value="1">Austro</option>
                                                <option value="2">Bolivariano</option>
                                                <option value="3">Guayaquil</option>
                                                <option value="4">Pichincha</option>
                                                <option value="5">Produbanco</option>
                                                </select></td>
                                    </tr>
                                    <tr>
                                        <th>Bin Seguridad</th>
                                        <th><input type="password" name="txt_tarjeta_seguridad" value="" size="50" /></th>
                                    </tr>
                                    <tr>
                                        <td>Pagar</td>
                                        <td><input type="submit" value="Finalizar Compra" name="btn_terminar_compra" /></td>
                                    </tr>

                                </tbody>

                            </table>
                        </div>
                    </form>';

