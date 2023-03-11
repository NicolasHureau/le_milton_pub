<?php
    ob_start();
?>
    <section>
        <h3>Entrées & Salades</h3>
        <table>
            <tbody>
                <tr>
                    <th class="dish">Nom du plat</th>
                    <td class="dot"></td>
                    <td class="price">19.99</td>
                </tr>
                <tr>
                    <td class="description">Description du plat</td>
                </tr>
                <tr>
                    <th class="dish">Nom du plat</th>
                    <td class="dot"></td>
                    <td class="price">19.99</td>
                </tr>
                <tr>
                    <td class="description">Description du plat</td>
                </tr>

            </tbody>
        </table>

        <h3>Spécialités Savoyardes</h3>
        <table>
            <tbody>
                <tr>
                    <th class="dish">Nom du plat</th>
                    <td class="dot"></td>
                    <td class="price">19.99</td>
                </tr>
                <tr>
                    <td class="description">Description du plat</td>
                </tr>
                <tr>
                    <th class="dish">Nom du plat</th>
                    <td class="dot"></td>
                    <td class="price">19.99</td>
                </tr>
                <tr>
                    <td class="description">Description du plat</td>
                </tr>
            </tbody>
        </table>

        <h3>Moules</h3>
        <table>
            <tbody>
                <tr>
                    <th class="dish">Nom du plat</th>
                    <td class="dot"></td>
                    <td class="price">19.99</td>
                </tr>
                <tr>
                    <td class="description">Description du plat</td>
                </tr>
                <tr>
                    <th class="dish">Nom du plat</th>
                    <td class="dot"></td>
                    <td class="price">19.99</td>
                </tr>
                <tr>
                    <td class="description">Description du plat</td>
                </tr>
            </tbody>
        </table>

        <h3>Burgers</h3>
        <table>
            <tbody>
                <tr>
                    <th class="dish">Nom du plat</th>
                    <td class="dot"></td>
                    <td class="price">19.99</td>
                </tr>
                <tr>
                    <td class="description">Description du plat</td>
                </tr>
                <tr>
                    <th class="dish">Nom du plat</th>
                    <td class="dot"></td>
                    <td class="price">19.99</td>
                </tr>
                <tr>
                    <td class="description">Description du plat</td>
                </tr>
            </tbody>
        </table>

        <h3>Viandes</h3>
        <table>
            <tbody>
                <tr>
                    <th class="dish">Nom du plat</th>
                    <td class="dot"></td>
                    <td class="price">19.99</td>
                </tr>
                <tr>
                    <td class="description">Description du plat</td>
                </tr>
                <tr>
                    <th class="dish">Nom du plat</th>
                    <td class="dot"></td>
                    <td class="price">19.99</td>
                </tr>
                <tr>
                    <td class="description">Description du plat</td>
                </tr>
            </tbody>
        </table>

    </section>
<?php
    $content = ob_get_clean();
    require('menu.php');
?>