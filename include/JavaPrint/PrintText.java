
package applet;

import java.applet.Applet;
import java.awt.*;
import java.awt.font.*;

import java.awt.print.*;


//import java.text.*;

//import java.lang.*;



class ImprimeText implements Printable {
  //  private AttributedString mStyledText;
   String cadena[][];

    public void cad(String cadena[][]){
        this.cadena=cadena;
            //mStyledText = new AttributedString(cadena);
    }
    public int print(Graphics g, PageFormat format, int pageIndex) {

      // format.setOrientation(PageFormat.PORTRAIT );
   Graphics2D g2d = (Graphics2D) g;
   g2d.translate(format.getImageableX(), format.getImageableY());

   // Image img1 = Toolkit.getDefaultToolkit().getImage("C:\\reporte.jpg");
    //g2d.drawImage(img1,new AffineTransform(),new ImageObserver(){imageUpdate();});

  //  g2d.drawImage(img1,10,10,null);

    //g2d.finalize();

  /*    g2d.setColor(Color.red);
      g2d.drawRect(100,130,200,20);
      g2d.setColor(new Color(120,23,24));
      g2d.fillRect(100,180,200,20);

      g2d.setColor(Color.magenta);
      g2d.drawLine(100,400,100,600);
*/


    int tam=cadena.length;
    int tama=8;
    int i=0;
    try{
    for(i=0;i<tam;i++){
        if(this.cadena[i][6].toLowerCase().equals("img")){
            Image img1 = Toolkit.getDefaultToolkit().getImage(this.cadena[i][0]);
            g2d.drawImage(img1,Integer.parseInt(this.cadena[i][1]),Integer.parseInt(this.cadena[i][2]),null);
        }
        else if(this.cadena[i][6].toLowerCase().equals("borde")){
            String [] rgb = cadena[i][0].split(",");
            g2d.setColor(new Color(Integer.parseInt(rgb[0]),Integer.parseInt(rgb[1]),Integer.parseInt(rgb[2])));
            g2d.drawRect(Integer.parseInt(this.cadena[i][1]),Integer.parseInt(this.cadena[i][2]),Integer.parseInt(this.cadena[i][3]),Integer.parseInt(this.cadena[i][4]));
        }
        else if(this.cadena[i][6].toLowerCase().equals("relleno")){
            String [] rgb = cadena[i][0].split(",");
            g2d.setColor(new Color(Integer.parseInt(rgb[0]),Integer.parseInt(rgb[1]),Integer.parseInt(rgb[2])));
            g2d.fillRect(Integer.parseInt(this.cadena[i][1]),Integer.parseInt(this.cadena[i][2]),Integer.parseInt(this.cadena[i][3]),Integer.parseInt(this.cadena[i][4]));
        }
        else if(this.cadena[i][6].toLowerCase().equals("linea")){
            String [] rgb = cadena[i][0].split(",");
            g2d.setColor(new Color(Integer.parseInt(rgb[0]),Integer.parseInt(rgb[1]),Integer.parseInt(rgb[2])));
            g2d.drawLine(Integer.parseInt(this.cadena[i][1]),Integer.parseInt(this.cadena[i][2]),Integer.parseInt(this.cadena[i][3]),Integer.parseInt(this.cadena[i][4]));
        }
        else{
             if(this.cadena[i][5].toLowerCase().equals("")){
                    tama=8;
             }
            else{
                 tama=Integer.parseInt(this.cadena[i][5]);
            }
            add(g2d, format, this.cadena[i][0],Float.parseFloat(this.cadena[i][1]),Float.parseFloat(this.cadena[i][2]),this.cadena[i][3],this.cadena[i][4],tama,this.cadena[i][6]);
        }
    }
    } catch (ArrayIndexOutOfBoundsException exception){
          System.err.println("Error de Arreglo adentro: " + exception);
        }

    return Printable.PAGE_EXISTS;
  }

  public void add(Graphics2D g2d, PageFormat format, String cadena,float x, float y,String fuente, String estilo, int tam, String color) {
    /*AttributedString mSText = new AttributedString(cadena);

    AttributedCharacterIterator charIterator = mSText.getIterator();
    LineBreakMeasurer measurer = new LineBreakMeasurer(charIterator, g2d.getFontRenderContext());
    float wrappingWidth = (float) format.getImageableWidth();
    TextLayout layout = measurer.nextLayout(wrappingWidth);
    */



    if(!color.equals("") && !color.toLowerCase().equals("text")){
         String [] rgb = color.split(",");
         g2d.setColor(new Color(Integer.parseInt(rgb[0]),Integer.parseInt(rgb[1]),Integer.parseInt(rgb[2])));
        //g2d.setPaint(Color.blue);
    }
    else{
       g2d.setColor(Color.black);
    }
    if(fuente.equals("")){
        fuente="Courier";
    }
    Font font;
    if(estilo.equals("B")){
        font=new Font(fuente,Font.BOLD,tam);
    }
    else if(estilo.equals("I")){
        font=new Font(fuente,Font.ITALIC,tam);
    }
    else if(estilo.equals("BI")){
        font=new Font(fuente,Font.BOLD+Font.ITALIC,tam);
    }
    else{
        font=new Font(fuente,Font.PLAIN,tam);
    }
/*
   // StyleContext context = new StyleContext();
    StyledDocument st=cadena.getStyledDocument();

   // StyledDocument document = new DefaultStyledDocument(context);
 SimpleAttributeSet bSet = new SimpleAttributeSet();
 StyleConstants.setAlignment(bSet, StyleConstants.ALIGN_RIGHT);
 st.setParagraphAttributes(0,cadena.length(), bSet, false);
// cadena.updateUI();
 */


    FontRenderContext frc = g2d.getFontRenderContext();
   TextLayout layout = new TextLayout(cadena, font, frc);

    layout.draw(g2d,x,y);
  }
}

class Imprime{
    PrinterJob printerJob = PrinterJob.getPrinterJob();
    Book book = new Book();

public void agregar(String cadena[][],String orientacion,String anchoP,String altoP)
{
       ImprimeText objT=new ImprimeText();
   objT.cad(cadena);
   PageFormat pageF=new PageFormat();
   Paper paper = new Paper();

   Double ancho=Double.parseDouble(anchoP);
    Double alto=Double.parseDouble(altoP);
   if(ancho==0){
       ancho=paper.getWidth();
   }
   if(alto==0){
       alto=paper.getHeight();
   }
     paper.setSize(ancho,alto);

   paper.setImageableArea(paper.getImageableX()-72,paper.getImageableY()-72, paper.getImageableWidth()+144, paper.getImageableHeight()+144);
  // paper.setSize(paper.getWidth(), (paper.getHeight()/2)+30);
  // System.out.println("ancho:"+paper.getWidth());
   //System.out.println("alto:"+paper.getHeight());

   pageF.setPaper(paper);
   if(orientacion.toLowerCase().equals("L")){
        pageF.setOrientation(PageFormat.LANDSCAPE );
    }
    else{
        pageF.setOrientation(PageFormat.PORTRAIT  );
    }
    this.book.append(objT, pageF);

    objT=null;
    pageF=null;
    paper=null;
}

public void imprimir(String dialog)
{
   this.printerJob.setPageable(book);
    this.book = new Book();

  if(dialog.toLowerCase().equals("true")){
      boolean doPrint = this.printerJob.printDialog();
      if (doPrint) {
        try {
          this.printerJob.print();
        } catch (PrinterException exception){
          System.err.println("Printing error: " + exception);
        }
      }
    }
    else{
        try {
          this.printerJob.print();
        } catch (PrinterException exception){
          System.err.println("Printing error: " + exception);
        }
    }


   this.printerJob=null;
   this.book=null;
}

}
public class PrintText extends Applet{
Imprime imp;
public Imprime creaImp()
{
   imp=new Imprime();
   return imp;
}

public void agregar(String cadena[][],String orientacion,String anchoP,String altoP)
{
       this.imp.agregar(cadena,orientacion,anchoP,altoP);
}

public void imprimir(String dialog)
{
   this.imp.imprimir(dialog);
}


    public void init() {
     
        String dic[][] = {
       {"120,20,20","98","290","200","12","","borde"},
       {"120,20,20","98","190","200","12","","relleno"},

       {"120,20,20","8","288","200","288","","linea"},
       {"120,20,20","8","300","200","300","","linea"},


       {"C:\\reporte.jpg","10","10","SansSerif.","","8","Img"}

       };

    //   agregar(dic,"P","612","792");


       String dic1[][] = {
       {"en este moemtno EN ESTE MOMENTO","10","290","Helvetica","","12","Text"},
       {"en este moemtno EN ESTE MOMENTOen este moemtno EN ESTE MOMENTOen este moemtno EN ESTE MOMENTOen este moemtno EN ESTE MOMENTOen este moemtno EN ESTE MOMENTOen este moemtno EN ESTE MOMENTOen este moemtno EN ESTE MOMENTOen este moemtno EN ESTE MOMENTOen este moemtno EN ESTE MOMENTO","0","310","Serif","","12","Text"},
       {"en este moemtno EN ESTE MOMENTO","10","330","Serif","","12","Text"},
       {"en este moemtno EN ESTE MOMENTO","10","360","courier","","12","Text"},

       {"en este moemtno EN ESTE MOMENTO","10","390","Times","","12","Text"},

        {"120,20,20","8","288","200","288","","linea"},
        {"120,20,20","8","300","200","300","","linea"},
        {"120,20,20","8","100","8","300","","linea"},

       {"C:\\reporte.jpg","10","10","SansSerif","","8",""}

       };

        creaImp();
        agregar(dic1,"P","612","396");
        agregar(dic,"P","612","792");

        imprimir("false");

        creaImp();
        agregar(dic,"P","612","792");
        imprimir("false");

    }
}
