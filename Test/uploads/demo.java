import java.awt.BorderLayout;
import java.awt.GridLayout;
import java.awt.Color;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import javax.swing.JFrame;
import javax.swing.JMenu;
import javax.swing.JMenuBar;
import javax.swing.JMenuItem;
import javax.swing.JPanel;
import javax.swing.JButton;
import javax.swing.JLabel;
import javax.swing.JTextField;

public class demo extends JFrame{

private JPanel panel1 = new JPanel();
private JPanel panel2 = new JPanel();
JButton b;
JLabel l,l1,l2,l3,l4,l5;
JTextField t1,t2,t3,t4,t5;
public demo(){
    setDefaultCloseOperation(EXIT_ON_CLOSE);
    initMenu();
    setLayout(new GridLayout(6,2));
}

private class MenuAction implements ActionListener {

    private JPanel panel;
    private MenuAction(JPanel pnl) {
        this.panel = pnl;
    }
    public void actionPerformed(ActionEvent e) {
        changePanel(panel);

    }

}

private void initMenu() {
    JMenuBar menubar = new JMenuBar();
    JMenu menu = new JMenu("Menu");
    JMenuItem menuItem1 = new JMenuItem("Panel1");
    JMenuItem menuItem2 = new JMenuItem("Panel2");
    b = new JButton("connect");
    l1 = new JLabel("Server Name ");
    l2 = new JLabel("Port Name ");
    l3 = new JLabel("Database Name  Name ");
    l4 = new JLabel("Username  Name ");
    l5 = new JLabel("Password ");
    t1 = new JTextField(20);
    t2 = new JTextField(20);
    t3 = new JTextField(20);
    t4 = new JTextField(20);
    t5 = new JTextField(20);
    l = new JLabel();
    menubar.add(menu);
    menu.add(menuItem1);
    menu.add(menuItem2);
    setJMenuBar(menubar);
    panel1.add(l1);
    panel1.add(t1);
    panel1.add(l2);
    panel1.add(t5);
    panel1.add(l3);
    panel1.add(t2);
    panel1.add(l4);
    panel1.add(t3);
    panel1.add(l5);
    panel1.add(t4);
    panel1.add(b);
    panel1.add(l);
    menuItem1.addActionListener(new MenuAction(panel1));
    menuItem2.addActionListener(new MenuAction(panel2));

}

private void changePanel(JPanel panel) {
    getContentPane().removeAll();
    getContentPane().add(panel, BorderLayout.CENTER);
    getContentPane().doLayout();
    update(getGraphics());
}

public static void main(String[] args) {
    demo frame = new demo();
    frame.setBounds(200, 200, 300, 200);
    frame.setVisible(true);
    frame.setLayout(new GridLayout(6,2));
}
}
