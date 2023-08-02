package imdb_test;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.FileNotFoundException;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

public class main {

	 public static void mergeSort(String[] array) {
	        if (array == null || array.length <= 1) {
	            return; // Base case: already sorted or empty
	        }

	        int mid = array.length / 2;
	        String[] leftArray = new String[mid];
	        String[] rightArray = new String[array.length - mid];

	        // Splitting the array into two halves
	        System.arraycopy(array, 0, leftArray, 0, mid);
	        System.arraycopy(array, mid, rightArray, 0, array.length - mid);

	        // Recursive calls to sort the two halves
	        mergeSort(leftArray);
	        mergeSort(rightArray);

	        // Merging the sorted halves
	        merge(array, leftArray, rightArray);
	    }

	    private static void merge(String[] array, String[] leftArray, String[] rightArray) {
	        int i = 0; // Index for leftArray
	        int j = 0; // Index for rightArray
	        int k = 0; // Index for array

	        // Comparing and merging elements from leftArray and rightArray
	        while (i < leftArray.length && j < rightArray.length) {
	            if (Integer.parseInt(leftArray[i].substring(2, leftArray[i].indexOf("\t"))) <= 
	            	Integer.parseInt(rightArray[j].substring(2, rightArray[j].indexOf("\t")))) {
	                array[k] = leftArray[i];
	                i++;
	            } else {
	                array[k] = rightArray[j];
	                j++;
	            }
	            
	            k++;
	        }

	        // Copying remaining elements from leftArray, if any
	        while (i < leftArray.length) {
	            array[k] = leftArray[i];
	            i++;
	            k++;
	        }

	        // Copying remaining elements from rightArray, if any
	        while (j < rightArray.length) {
	            array[k] = rightArray[j];
	            j++;
	            k++;
	        }
	    }
	
	
	
	public static void main(String[] args) {
		try {
			BufferedReader titles = new BufferedReader(new FileReader("data_titles.tsv"));
			BufferedReader ratings = new BufferedReader(new FileReader("data_ratings.tsv"));
			BufferedReader principals = new BufferedReader(new FileReader("data_principals.tsv"));
			BufferedReader names = new BufferedReader(new FileReader("data_names.tsv"));

			BufferedWriter res = new BufferedWriter(new FileWriter("res.txt"));
			BufferedWriter res2 = new BufferedWriter(new FileWriter("res2.txt"));
			
			String line = titles.readLine();
			String line2 = principals.readLine();
			String line3 = names.readLine();
			
			while((line = titles.readLine()) != null) {
				String[] data = line.split("\t");
				if(data[5].equals("\\N")) continue;
				if(Integer.parseInt(data[5]) < 2022) continue;
				if(!data[1].equals("movie") && !data[1].equals("tvSeries")) continue;
				//System.out.println(data[0]);
				while(line2 != null && !line2.split("\t")[0].equals(data[0]) && line2.split("\t")[0].compareTo(data[0]) < 0) line2 = principals.readLine();
				if(line2 == null) { break; }
				if(line2.split("\t")[0].compareTo(data[0]) > 0) continue;
				
				String[] data2 = line2.split("\t");
				while(line2 != null && data2[0].equals(data[0])) {
					if(data2[3].equals("actor") || data2[3].equals("actress") || data2[3].equals("director")) {
						
						res.write(data[0] + "\t" + data[1] + "\t" + data[2] + "\t" +
								data[3] + "\t" + data[4] + "\t" + data[5] + "\t" + data[6] + "\t" + data[7] + "\t" + 
								data[8] + "\n");
						res2.write(data2[2] + "\t" + data[0] + "\t" + data[2] +  "\t" + data2[3] + "\n");
					}
					
					line2 = principals.readLine();
					data2 = line2.split("\t");
				}		
			}
			System.out.println("1/5 done.");
			titles.close();
			principals.close();
			res.close();
			res2.close();
			BufferedReader res2r = new BufferedReader(new FileReader("res2.txt"));
			List<String> lines = new ArrayList<>(); 
			while((line2 = res2r.readLine()) != null) lines.add(line2);
			
			
			res2r.close();
			
			String[] sending = new String[lines.size()];
			sending = lines.toArray(sending);
			mergeSort(sending);
			System.out.println("2/5 done.");
			BufferedWriter res3 = new BufferedWriter(new FileWriter("res3.txt"));
			for(String s: sending) {
				String[] x = s.split("\t");
				
				res3.write(x[0] + "\t" + x[1] + "\t" + x[2] + "\t" + x[3] + "\n");
			}
			
			res3.close();
			
			BufferedReader res3r = new BufferedReader(new FileReader("res3.txt"));
			BufferedWriter res4 = new BufferedWriter(new FileWriter("res4.txt"));
			
			while((line2 = res3r.readLine()) != null) {
			
				while(line3 != null && !line3.split("\t")[0].equals(line2.split("\t")[0]) && line3.split("\t")[0].compareTo(line2.split("\t")[0]) < 0) line3 = names.readLine();
				if(line3 == null) { break; }
				if(line3.split("\t")[0].compareTo(line2.split("\t")[0]) > 0) { continue; }
				
				res4.write(line2.split("\t")[1] + "\t" + line3.split("\t")[1] + "\t" + line2.split("\t")[2] + "\t" + line2.split("\t")[3] + "\n");
				
			}
			names.close();
			res3r.close();
			res4.close();
			System.out.println("3/5 done.");	
			BufferedReader res1r = new BufferedReader(new FileReader("res.txt"));
			BufferedReader res4r = new BufferedReader(new FileReader("res4.txt"));
			
			List<String> lines4 = new ArrayList<>(); 
			while((line2 = res4r.readLine()) != null) lines4.add(line2);
			res4r.close();
			String[] sending4 = new String[lines4.size()];
			sending4 = lines4.toArray(sending4);
			//System.out.println(sending4.length);
			mergeSort(sending4);	
			//System.out.println(sending4.length);
			System.out.println("4/5 done.");
			BufferedWriter res6 = new BufferedWriter(new FileWriter("res6.txt"));
			for(String s: sending4) {
				res6.write(s + "\n");
			}
			res6.close();
			BufferedReader res6r = new BufferedReader(new FileReader("res6.txt"));
			
			BufferedWriter res5 = new BufferedWriter(new FileWriter("res5.txt"));
			
			String line6 = "a", broj = "tt0";
			
			res5.write("INSERT INTO naslov(Ime, Godina, Zanr, Cena, Link, Opis, BrPoena, Slika, ProsOcena, Kategorija, Trajanje,"
					+ " BrSezona, NosiPoena, CenaIznajmljivanje, PoeniIznajmljivanje) VALUES ");
			
			
			String line7 = ratings.readLine();
			
			int k = 0;
			while((line = res1r.readLine()) != null) {
				String[] podaci = line.split("\t");

				String tip = podaci[1];
				if(tip.equals("movie")) tip = "Film"; 
				else tip = "Serija";
				String ime = podaci[2];
				String godina = podaci[5];
				String minuti = podaci[7];
				int cena = 0;
				if(minuti.equals("\\N")) { cena = 100; minuti = "0"; }
				else cena = Integer.parseInt(minuti);
				String[] zanroviS = podaci[8].split(",");
				int i = 0;
				for(String zanrS: zanroviS) {
					if(zanrS.equals("Romance")) zanrS = "Romansa";
					else if(zanrS.equals("Action")) zanrS = "Akcija";
					else if(zanrS.equals("Documentary")) zanrS = "Dokumentarac";
					else if(zanrS.equals("Comedy")) zanrS = "Komedija";
					else if(zanrS.equals("Animation")) zanrS = "Crtani";
					else if(zanrS.equals("Short")) zanrS = "Kratki";
					else if(zanrS.equals("Fantasy")) zanrS = "Fantastika";
					else if(zanrS.equals("Horror")) zanrS = "Horor";
					else if(zanrS.equals("News")) zanrS = "Informativni";
					else if(zanrS.equals("War")) zanrS = "Ratni";
					else if(zanrS.equals("Crime")) zanrS = "Krimi";
					else if(zanrS.equals("Western")) zanrS = "Vestern";
					else if(zanrS.equals("Sport")) zanrS = "Sportski";
					else if(zanrS.equals("Family")) zanrS = "PorodiÄ�ni";
					else if(zanrS.equals("Adventure")) zanrS = "Avantura";
					else if(zanrS.equals("Biography")) zanrS = "Biografija";
					else if(zanrS.equals("History")) zanrS = "Istorijski";
					else if(zanrS.equals("Music")) zanrS = "MuziÄ�ki";
					else if(zanrS.equals("Thriller")) zanrS = "Triler";
					else if(zanrS.equals("Mystery")) zanrS = "Misterija";
					else if(zanrS.equals("Reality-TV")) zanrS = "Rijaliti";
					else if(zanrS.equals("Sci-Fi")) zanrS = "NauÄ�na fantastika";
					else if(zanrS.equals("Musical")) zanrS = "Mjuzikl";
					zanroviS[i] = zanrS; i++;
				}
				String zanrovi = "";
				for(String zanrS: zanroviS) {
					zanrovi += zanrS + ", ";
				}
				zanrovi = zanrovi.substring(0, zanrovi.length() - 2);
				String opis = "";
				
				if(Integer.parseInt(broj.substring(2)) < Integer.parseInt(podaci[0].substring(2))) {
					line6 = res6r.readLine();
					broj = line6.split("\t")[0];
				}
				while(line6 != null && Integer.parseInt(broj.substring(2)) < Integer.parseInt(podaci[0].substring(2))) { 
					line6 = res6r.readLine();
					if(line6 == null) break;
					broj = line6.split("\t")[0];
				}
			
				if(line6 == null) { break; }
				if(Integer.parseInt(broj.substring(2)) > Integer.parseInt(podaci[0].substring(2))) continue;
				
				while(line6 != null && Integer.parseInt(broj.substring(2)) == Integer.parseInt(podaci[0].substring(2))) {
					opis += line6.split("\t")[1] + " - " + line6.split("\t")[3] + "; ";
					line6 = res6r.readLine();
					if(line6 == null) break;
					broj = line6.split("\t")[0];
				}
		
				while((line7 = ratings.readLine()) != null && line7.split("\t")[0].compareTo(line.split("\t")[0]) < 0) line7 = ratings.readLine();
				if(line7 == null) { break; }
				if(line7.split("\t")[0].compareTo(line.split("\t")[0]) > 0) continue;
				
				double ocena = Double.parseDouble(line7.split("\t")[1]);
				
				int brSezona = 0;
				if(tip.equals("serija")) {
					if(!line.split("\t")[6].equals("\\N"))
						brSezona = Integer.parseInt(line.split("\t")[6]) - Integer.parseInt(line.split("\t")[5]) + 1;
					else brSezona = 2024 - Integer.parseInt(line.split("\t")[5]);
				}
				
				ime.replace('\"', '\'');
				opis.replace('\"', '\'');
				
				if(k > 0) res5.write(", \n");
				
				res5.write("(\"" + ime + "\", " + godina + ", \"" + zanrovi + "\", " + cena + ", \"pristupnilink" + k + "\", "
						+ "\"" + opis + "\", " +  cena + ", NULL, " + ocena + ", \"" + tip + "\", \"" + minuti + "\", " + brSezona + ", " + cena/5 + ", " + cena/2 + ", " + cena/2 + ")");
				k++;
			}
			
			res5.write(";");
			
			ratings.close();

			res1r.close();
			res5.close();
			res6r.close();
			
			System.out.println("5/5 done.");
			
		} catch (IOException e) {
			e.printStackTrace();
		}
		

	}

}
