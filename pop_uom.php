<?php
    $pop = $mysqli->query($sql);
    if ($pop){
        $count = $pop->num_rows;
        if ($count > 0){
            while($row=$pop->fetch_object()){
                $id = $row->id;
                $uom = $row->uom;
                $description = $row->description;
                
                echo "<tr>";
                echo "   <td class='text-center'>";
                echo "    <a id='{$id}' class='btn_uom_modify btn btn-info btn-xs fa fa-pencil' title='Modify UOM' ></a>";
                echo "   </td>";
                echo "   <td>{$uom}</td>";
                echo "   <td>{$description}</td>";
                echo "</tr>";
            }
        }else{
            echo "<tr>";
            echo "   <td colspan='3' align='center'>No Record Found</td>";
            echo "</tr>";
        }
    }else{
        echo "Error: " . $mysqli->error;
    }
?>